<?php

namespace Botble\Tour\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Language\Facades\Language;
use Botble\Theme\Facades\Theme;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Botble\Combo\Models\Combo;
use Botble\Tour\Forms\TourForm;
use Botble\Tour\Http\Requests\TourRequest;
use Botble\Tour\Models\Tour;
use Botble\Tour\Models\TourCategory;
use Botble\Tour\Tables\TourTable;
use Carbon\Carbon;

class TourController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/tour::tour.name'), route('tour.index'));
    }

    public function index(TourTable $table)
    {
        $this->pageTitle(trans('plugins/tour::tour.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/tour::tour.create'));

        return TourForm::create()->renderForm();
    }

    public function store(TourRequest $request)
    {
        $categoryIds = array_values($request->input('categories', []));

        $form = TourForm::create()->setRequest($request);

        $form->save();

        $tour = $form->getModel();

        if ($request->filled('created_at')) {
            try {
                $tour->forceFill([
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->input('created_at')),
                ]);

                $originalTimestamps = $tour->timestamps;
                $tour->timestamps = false;
                $tour->save();
                $tour->timestamps = $originalTimestamps;
            } catch (\Throwable) {
                // ignore
            }
        }

        $pluginId = function_exists('tour_plugin_id')
            ? tour_plugin_id()
            : 'al/tour';
        $tour->categories()->syncWithPivotValues($categoryIds, ['plugin_id' => $pluginId]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('tour.index'))
            ->setNextUrl(route('tour.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Tour $tour)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $tour->name]));

        return TourForm::createFromModel($tour)->renderForm();
    }

    public function update(Tour $tour, TourRequest $request)
    {
        $categoryIds = array_values($request->input('categories', []));

        TourForm::createFromModel($tour)
            ->setRequest($request)
            ->save();

        if ($request->filled('created_at')) {
            try {
                $tour->forceFill([
                    'created_at' => Carbon::createFromFormat('d/m/Y', $request->input('created_at')),
                ]);

                $originalTimestamps = $tour->timestamps;
                $tour->timestamps = false;
                $tour->save();
                $tour->timestamps = $originalTimestamps;
            } catch (\Throwable) {
                // ignore
            }
        }

        $pluginId = function_exists('tour_plugin_id')
            ? tour_plugin_id()
            : 'al/tour';
        $tour->categories()->syncWithPivotValues($categoryIds, ['plugin_id' => $pluginId]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('tour.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Tour $tour)
    {
        return DeleteResourceAction::make($tour);
    }

    public function publicIndex()
    {
        $tourName = trans('plugins/tour::tour.name');
        $categoryModel = null;

        $groups = TourCategory::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where(function ($query) {
                $query->whereNull('parent_id')->orWhere('parent_id', 0);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function (TourCategory $category) {
                $items = $category
                    ->tours()
                    ->where('tours.status', BaseStatusEnum::PUBLISHED)
                    ->orderBy('tours.created_at', 'asc')
                    ->take(8)
                    ->get();

                return [
                    'category' => $category,
                    'items' => $items,
                ];
            })
            ->filter(fn(array $group) => $group['items']->count() > 0)
            ->values();

        $tour = Tour::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'asc')
            ->paginate(12)
            ->withQueryString();

        SeoHelper::setTitle($tourName);

        return Theme::scope(
            'tour-page',
            compact('tour', 'tourName', 'categoryModel', 'groups'),
            'plugins/tour::tour-page'
        )
            ->layout('default-no-sidebar')
            ->render();
    }

    public function publicHandle(string $slug)
    {
        $tour = $this->findTourByLink($slug);

        if ($tour) {
            return $this->renderTourDetail($tour);
        }

        $categoryModel = $this->findCategoryBySlug($slug);
        if ($categoryModel) {
            return $this->renderCategory($categoryModel);
        }

        abort(404);
    }

    public function publicHandleNested(string $category, string $slug)
    {
        return $this->detail($category, $slug);
    }

    public function publicItinerary(Request $request, string $slug = null)
    {
        // If a slug parameter is present, try to find a tour by link
        if ($slug) {
            $tour = $this->findTourByLink($slug);
            if ($tour) {
                // prepare content and policy (normalize and run shortcodes)
                $tour->intro = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->intro ?? '')));
                $tour->content = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->content ?? '')));
                $tour->policy = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->policy ?? '')));

                // parse timeline shortcodes into structured items
                $rawContent = (string) ($tour->getRawOriginal('content') ?? $tour->content ?? '');
                $timelineItems = [];
                try {
                    // find [timeline]...[/timeline] blocks
                    if (preg_match_all('/\[timeline[^\]]*\](.*?)\[\/timeline\]/s', $rawContent, $blocks)) {
                        foreach ($blocks[1] as $block) {
                            // first try explicit timeline_item tags
                            if (preg_match_all('/\[(?:timeline[_-]?item)([^\]]*)\](.*?)\[\/timeline[_-]?item\]/s', $block, $its, PREG_SET_ORDER)) {
                                foreach ($its as $it) {
                                    $attrString = $it[1] ?? '';
                                    $inner = trim($it[2] ?? '');
                                    $attrs = [];
                                    if (preg_match_all("/(\\w+)=(?:\"|')([^\"']+)(?:\"|')/s", $attrString, $as, PREG_SET_ORDER)) {
                                        foreach ($as as $a) {
                                            $attrs[$a[1]] = $a[2];
                                        }
                                    }
                                    $time = $attrs['time'] ?? null;
                                    $title = $attrs['title'] ?? null;
                                    // try to extract strong/time from inner
                                    if (! $time && preg_match('/<strong>([^<]+)<\/strong>/i', $inner, $m)) {
                                        $time = trim($m[1]);
                                        $inner = preg_replace('/<strong>.*?<\/strong>/i', '', $inner);
                                    }
                                    $timelineItems[] = [
                                        'time' => $time,
                                        'title' => $title,
                                        'content' => $inner,
                                    ];
                                }
                            } else {
                                // no explicit items: try to parse <p><strong>time</strong></p><p>content</p> patterns
                                if (preg_match_all('/<p>\s*<strong>([^<]+)<\/strong>\s*<\/p>\s*<p>(.*?)<\/p>/s', $block, $ps, PREG_SET_ORDER)) {
                                    foreach ($ps as $p) {
                                        $timelineItems[] = [
                                            'time' => trim(strip_tags($p[1])),
                                            'title' => null,
                                            'content' => trim($p[2]),
                                        ];
                                    }
                                } else {
                                    // fallback: split by lines and detect time-like prefixes
                                    $lines = preg_split('/\r?\n/', strip_tags($block));
                                    foreach ($lines as $line) {
                                        $line = trim($line);
                                        if ($line === '') {
                                            continue;
                                        }
                                        if (preg_match('/^([0-2]?\d[:h][0-5]\d(?:\s*-\s*[0-2]?\d[:h][0-5]\d)?)/i', $line, $m)) {
                                            $time = $m[1];
                                            $content = trim(substr($line, strlen($m[0])));
                                            $timelineItems[] = ['time' => $time, 'title' => null, 'content' => $content];
                                        } else {
                                            // append to last item if exists
                                            if (! empty($timelineItems)) {
                                                $timelineItems[count($timelineItems) - 1]['content'] .= '\n' . $line;
                                            } else {
                                                $timelineItems[] = ['time' => null, 'title' => null, 'content' => $line];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // also support self-closing [timeline ... /] blocks as single items
                    if (empty($timelineItems) && preg_match_all('/\[timeline([^\]]*)\/\]/s', $rawContent, $shorts, PREG_SET_ORDER)) {
                        foreach ($shorts as $s) {
                            $attrString = $s[1] ?? '';
                            $attrs = [];
                            if (preg_match_all("/(\\w+)=(?:\"|')([^\"']+)(?:\"|')/s", $attrString, $as, PREG_SET_ORDER)) {
                                foreach ($as as $a) {
                                    $attrs[$a[1]] = $a[2];
                                }
                            }
                            $timelineItems[] = [
                                'time' => $attrs['time'] ?? null,
                                'title' => $attrs['title'] ?? null,
                                'content' => $attrs['content'] ?? null,
                            ];
                        }
                    }
                } catch (\Throwable $e) {
                    $timelineItems = [];
                }

                return Theme::scope(
                    'itinerary-detail-page',
                    compact('tour', 'timelineItems'),
                    'plugins/tour::itinerary-detail-page'
                )
                    ->layout('default-no-sidebar')
                    ->render();
            }
        }
    }

    protected function findCategoryBySlug(string $slug, ?int $parentId = null): ?TourCategory
    {
        $query = TourCategory::query()->where('slug', $slug);

        if ($parentId !== null) {
            $query->where('parent_id', $parentId);
        }

        $categoryModel = $query->first();

        // Support translated category slug
        if (! $categoryModel && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
            try {
                $locale = Language::getCurrentLocaleCode();

                $translatedQuery = TourCategory::query();

                if ($parentId !== null) {
                    $translatedQuery->where('parent_id', $parentId);
                }

                $categoryModel = $translatedQuery
                    ->whereHas('translations', function ($query) use ($locale, $slug) {
                        $query
                            ->where('lang_code', $locale)
                            ->where('slug', $slug);
                    })
                    ->first();
            } catch (\Throwable) {
                // ignore
            }
        }

        return $categoryModel;
    }

    protected function renderCategory(TourCategory $categoryModel)
    {
        $categoryName = $categoryModel->name;

        if (! empty($categoryModel->description)) {
            $categoryModel->description = do_shortcode($this->normalizeShortcodeMarkup((string) $categoryModel->description));
        }

        $children = TourCategory::query()
            ->where('parent_id', $categoryModel->getKey())
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'asc')
            ->get();

        $sections = $children
            ->map(function (TourCategory $child) {
                $baseQuery = $child
                    ->tours()
                    ->where('tours.status', BaseStatusEnum::PUBLISHED)
                    ->orderBy('tours.created_at', 'asc');

                $pageName = 'page_' . $child->getKey();
                $items = $baseQuery->paginate(8, ['*'], $pageName)->withQueryString();

                return [
                    'category' => $child,
                    'total' => $items->total(),
                    'items' => $items,
                ];
            })
            ->filter(fn(array $section) => $section['items']->count() > 0)
            ->values();

        if ($sections->isNotEmpty()) {
            SeoHelper::setTitle($categoryName);

            return Theme::scope(
                'tour-page',
                compact('categoryName', 'categoryModel', 'sections'),
                'plugins/tour::tour-page'
            )
                ->layout('default-no-sidebar')
                ->render();
        }

        $tour = $categoryModel
            ->tours()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->orderBy('created_at', 'asc')
            ->paginate(8)
            ->withQueryString();

        SeoHelper::setTitle($categoryName ?? ($tour->name ?? trans('plugins/tour::tour.name')));

        return Theme::scope(
            'tour-page',
            compact('tour', 'categoryName', 'categoryModel'),
            'plugins/tour::tour-page'
        )
            ->layout('default-no-sidebar')
            ->render();
    }

    public function category($category)
    {
        $categoryModel = $this->findCategoryBySlug($category);

        if (! $categoryModel) {
            abort(404);
        }

        return $this->renderCategory($categoryModel);
    }

    public function detail($category, $slug)
    {
        $categoryModel = $this->findCategoryBySlug($category);

        // Allow URLs like /{pageSlug}/{categorySlug} (e.g. /dich-vu/thue-xe) where the first
        // segment is a CMS Page slug, not a TourCategory slug.
        if (! $categoryModel) {
            $maybeCategory = $this->findCategoryBySlug($slug);

            if ($maybeCategory) {
                return $this->renderCategory($maybeCategory);
            }

            abort(404);
        }

        $tourQuery = Tour::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where(function ($query) use ($slug) {
                $query->where('link', $slug);

                // Support translated tour link
                if (function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                    try {
                        $locale = Language::getCurrentLocaleCode();

                        $query->orWhereHas('translations', function ($q) use ($locale, $slug) {
                            $q
                                ->where('lang_code', $locale)
                                ->where('link', $slug);
                        });
                    } catch (\Throwable) {
                        // ignore
                    }
                }
            });

        $tourQuery->whereHas('categories', function ($q) use ($categoryModel) {
            $q->whereKey($categoryModel->getKey());
        });

        $tour = $tourQuery->first();

        // Allow nested category URLs like /{parent}/{child} by treating "slug" as a child category
        // when no tour matches.
        if (! $tour) {
            $childCategory = $this->findCategoryBySlug($slug, $categoryModel->getKey());

            if ($childCategory) {
                return $this->renderCategory($childCategory);
            }

            abort(404);
        }

        return $this->renderTourDetail($tour);
    }

    protected function findTourByLink(string $slug): ?Tour
    {
        $tourQuery = Tour::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->where(function ($query) use ($slug) {
                $query->where('link', $slug);

                // Support translated tour link
                if (function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                    try {
                        $locale = Language::getCurrentLocaleCode();

                        $query->orWhereHas('translations', function ($q) use ($locale, $slug) {
                            $q
                                ->where('lang_code', $locale)
                                ->where('link', $slug);
                        });
                    } catch (\Throwable) {
                        // ignore
                    }
                }
            });

        return $tourQuery->first();
    }

    protected function renderTourDetail(Tour $tour)
    {
        $tour->intro = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->intro ?? '')));
        $tour->content = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->content ?? '')));
        $tour->policy = do_shortcode($this->normalizeShortcodeMarkup((string) ($tour->policy ?? '')));

        // Optional: render sectioned lists inside a tour detail page.
        // Admin config: assign categories to this tour. Each assigned category becomes a section.
        $sections = $tour
            ->categories()
            ->where('tour_categories.status', BaseStatusEnum::PUBLISHED)
            ->orderBy('tour_categories.name')
            ->get()
            ->map(function (TourCategory $sectionCategory) use ($tour) {
                $pageName = 'page_' . $sectionCategory->getKey();

                $items = $sectionCategory
                    ->tours()
                    ->where('tours.status', BaseStatusEnum::PUBLISHED)
                    ->where('tours.id', '!=', $tour->getKey())
                    ->orderByDesc('tours.created_at')
                    ->paginate(8, ['*'], $pageName)
                    ->withQueryString();

                return [
                    'category' => $sectionCategory,
                    'items' => $items,
                ];
            })
            ->filter(fn(array $section) => $section['items']->count() > 0)
            ->values();

        SeoHelper::setTitle($tour->name)
            ->setDescription($tour->intro);

        $meta = new SeoOpenGraph();
        if ($tour->image) {
            $meta->setImage(RvMedia::getImageUrl($tour->image));
        }
        $meta->setDescription($tour->intro);
        $meta->setUrl($tour->url);
        $meta->setTitle($tour->name);
        $meta->setType('article');

        SeoHelper::setSeoOpenGraph($meta);

        SeoHelper::meta()->setUrl($tour->url);

        if (function_exists('do_action') && defined('BASE_ACTION_PUBLIC_RENDER_SINGLE')) {
            do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, 'tour', $tour);
        }

        return Theme::scope(
            'tour-detail-page',
            compact('tour', 'sections'),
            'plugins/tour::tour-detail-page'
        )
            ->layout('default-no-sidebar')
            ->render();
    }

    protected function normalizeShortcodeMarkup(string $content): string
    {
        if ($content === '') {
            return $content;
        }

        $content = preg_replace('/&(amp;)?#0*91;|&(amp;)?lbrack;|&(amp;)?#x0*5b;/i', '[', $content);
        $content = preg_replace('/&(amp;)?#0*93;|&(amp;)?rbrack;|&(amp;)?#x0*5d;/i', ']', $content);

        $content = preg_replace_callback('/\[[^\]]+\]/s', function (array $matches) {
            $tag = $matches[0];

            if (! preg_match('/^\[\/?[A-Za-z0-9_-]+(?:\s|\]|$)/', $tag)) {
                return $tag;
            }

            return html_entity_decode($tag, ENT_QUOTES, 'UTF-8');
        }, $content);

        return $content;
    }
}
