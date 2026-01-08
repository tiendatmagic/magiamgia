<?php

namespace Botble\Tour\Providers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\TreeCategoryField;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Supports\ServiceProvider;
use Botble\Language\Facades\Language;
use Botble\Menu\Events\RenderingMenuOptions;
use Botble\Menu\Facades\Menu;
use Botble\Menu\Models\MenuNode;
use Botble\Tour\Models\Tour;
use Botble\Tour\Models\TourCategory;
use Botble\Slug\Events\UpdatedPermalinkSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Menu::addMenuOptionModel(TourCategory::class);
        Menu::addMenuOptionModel(Tour::class);

        // TourCategory URLs share the same prefix as Tour.
        // When changing the Tour permalink prefix (possibly per-language), update category menu nodes too.
        $this->app['events']->listen(UpdatedPermalinkSettings::class, function (UpdatedPermalinkSettings $event) {
            if ($event->reference !== Tour::class) {
                return;
            }

            try {
                $locale = $event->request->input('ref_lang');
                $shouldSetLocale = $locale && function_exists('is_plugin_active') && is_plugin_active('language');
                $previousLocaleCode = null;

                if ($shouldSetLocale) {
                    Language::initModelRelations();
                    $previousLocaleCode = Language::getCurrentLocaleCode();
                    Language::setCurrentLocaleCode($locale);
                    Language::setCurrentLocale($locale);
                }

                $nodesQuery = MenuNode::query()->where('reference_type', TourCategory::class);

                if ($shouldSetLocale) {
                    $nodesQuery->whereHas('languageMeta', function ($query) use ($locale) {
                        $query->where('lang_meta_code', $locale);
                    });
                }

                $nodes = $nodesQuery->get();

                foreach ($nodes as $node) {
                    if (! $node->reference) {
                        continue;
                    }

                    $newUrl = str_replace(url(''), '', $node->reference->url);

                    if ($node->url != $newUrl) {
                        $node->url = $newUrl;
                        $node->save();
                    }
                }

                if ($shouldSetLocale && $previousLocaleCode) {
                    Language::setCurrentLocaleCode($previousLocaleCode);
                    Language::setCurrentLocale($previousLocaleCode);
                }
            } catch (\Throwable $throwable) {
                BaseHelper::logError($throwable);
            }
        });

        $this->app['events']->listen(RenderingMenuOptions::class, function () {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        });

        // Keep relationship fields visible when editing translations (Language Advanced v2)
        FormAbstract::beforeRendering(function (FormAbstract $form) {
            $model = $form->getModel();

            if (! $model instanceof Tour
                || ! is_in_admin()
                || ! defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')
                || ! Language::getRefLang()
                || Language::getCurrentAdminLocaleCode() === Language::getDefaultLocaleCode()) {
                return;
            }

            // Language Advanced removes non-translatable fields; categories are a relationship.
            if (! array_key_exists('categories[]', $form->getFields())) {
                $form->add(
                    'categories[]',
                    TreeCategoryField::class,
                    SelectFieldOption::make()
                        ->label('Danh mục tour')
                        ->choices(get_tour_categories_with_children())
                        ->required()
                        ->selected($model->categories()->pluck('tour_category_id')->all())
                        ->toArray()
                );
            }
        }, 1200);

        // Persist relationship + translated slugs when saving a translation
        if (defined('LANGUAGE_ADVANCED_ACTION_SAVED')) {
            add_action(LANGUAGE_ADVANCED_ACTION_SAVED, function ($data, $request) {
                if (! $request) {
                    return;
                }

                $locale = $request->input('language') ?: Language::getCurrentAdminLocaleCode();
                $pluginId = function_exists('tour_plugin_id')
                    ? tour_plugin_id()
                    : 'al/tour';

                if ($data instanceof Tour) {
                    if ($request->has('categories')) {
                        $categoryIds = array_values((array) $request->input('categories', []));
                        $data->categories()->syncWithPivotValues($categoryIds, ['plugin_id' => $pluginId]);
                    }

                    // auto-generate translated link if empty
                    if ($locale !== Language::getDefaultLocaleCode()) {
                        $link = (string) $request->input('link');
                        $name = (string) $request->input('name');

                        if (! $link && $name) {
                            $base = Str::slug($name);
                            $candidate = $base;
                            $i = 1;

                            while (DB::table('tours_translations as st')
                                ->join('tours as s', 's.id', '=', 'st.tours_id')
                                ->where('s.plugin_id', $pluginId)
                                ->where('st.lang_code', $locale)
                                ->where('st.link', $candidate)
                                ->where('st.tours_id', '!=', $data->getKey())
                                ->exists()) {
                                $candidate = $base.'-'.$i++;
                            }

                            DB::table('tours_translations')
                                ->where([
                                    'lang_code' => $locale,
                                    'tours_id' => $data->getKey(),
                                ])
                                ->update(['link' => $candidate]);
                        }
                    }
                }

                if ($data instanceof TourCategory) {
                    if ($locale !== Language::getDefaultLocaleCode()) {
                        $slug = (string) $request->input('slug');
                        $name = (string) $request->input('name');

                        if (! $slug && $name) {
                            $base = Str::slug($name);
                            $candidate = $base;
                            $i = 1;

                            while (DB::table('tour_categories_translations as ct')
                                ->join('tour_categories as c', 'c.id', '=', 'ct.tour_categories_id')
                                ->where('c.plugin_id', $pluginId)
                                ->where('ct.lang_code', $locale)
                                ->where('ct.slug', $candidate)
                                ->where('ct.tour_categories_id', '!=', $data->getKey())
                                ->exists()) {
                                $candidate = $base.'-'.$i++;
                            }

                            DB::table('tour_categories_translations')
                                ->where([
                                    'lang_code' => $locale,
                                    'tour_categories_id' => $data->getKey(),
                                ])
                                ->update(['slug' => $candidate]);
                        }
                    }
                }
            }, 1200, 2);
        }

        if (function_exists('is_plugin_active') && is_plugin_active('booking')) {
            add_filter('booking_admin_submenus', function (array $subMenus) {
                $subMenus[] = [
                    'id' => 'cms-plugins-booking-tour',
                    'parent_id' => 'cms-plugins-booking',
                    'priority' => 10,
                    'name' => 'plugins/booking::booking.menu_tour',
                    'icon' => 'ti ti-route',
                    'url' => fn () => route('bookings.index', ['booking_type' => 'tour']),
                    'permissions' => ['bookings.index'],
                ];

                return $subMenus;
            }, 50);

            add_filter('booking_booking_type_title', function ($title, $type) {
                if (! $title && $type === 'tour') {
                    return trans('plugins/booking::booking.menu_tour');
                }

                return $title;
            }, 50, 2);
        }
    }

    public function registerMenuOptions(): void
    {
        if (Auth::guard()->user()->hasPermission('tour-category.index')) {

            $name = trans('plugins/tour::tour.category');

            $items = TourCategory::query()
                ->where(function ($query) {
                    $query->whereNull('parent_id')->orWhere('parent_id', 0);
                })
                ->with(['children', 'children.children'])
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->orderBy('name')
                ->get();

            $options = Menu::generateSelect([
                'model' => new TourCategory,
                'items' => $items,
                'options' => [
                    'class' => 'list-unstyled list-item',
                ],
            ]);

            echo view('packages/menu::menu-options', compact('options', 'name'));
        }

        if (Auth::guard()->user()->hasPermission('tour.index')) {
            Menu::registerMenuOptions(
                Tour::class,
                trans('plugins/tour::tour.subpage')
            );
        }
    }
}
