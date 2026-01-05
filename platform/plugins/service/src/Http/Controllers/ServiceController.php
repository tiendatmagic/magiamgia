<?php

namespace Botble\Service\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Language\Facades\Language;
use Botble\Service\Forms\ServiceForm;
use Botble\Service\Http\Requests\ServiceRequest;
use Botble\Service\Models\Service;
use Botble\Service\Models\ServiceCategory;
use Botble\Service\Tables\ServiceTable;
use Botble\Theme\Facades\Theme;

class ServiceController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/service::service.name'), route('service.index'));
    }

    public function index(ServiceTable $table)
    {
        $this->pageTitle(trans('plugins/service::service.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/service::service.create'));

        return ServiceForm::create()->renderForm();
    }

    public function store(ServiceRequest $request)
    {
        $categoryIds = array_values($request->input('categories', []));

        $form = ServiceForm::create()->setRequest($request);

        $form->save();

        $service = $form->getModel();
        $pluginId = function_exists('service_plugin_id')
            ? service_plugin_id()
            : 'al/service';
        $service->categories()->syncWithPivotValues($categoryIds, ['plugin_id' => $pluginId]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('service.index'))
            ->setNextUrl(route('service.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(Service $service)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $service->name]));

        return ServiceForm::createFromModel($service)->renderForm();
    }

    public function update(Service $service, ServiceRequest $request)
    {
        $categoryIds = array_values($request->input('categories', []));

        ServiceForm::createFromModel($service)
            ->setRequest($request)
            ->save();

        $pluginId = function_exists('service_plugin_id')
            ? service_plugin_id()
            : 'al/service';
        $service->categories()->syncWithPivotValues($categoryIds, ['plugin_id' => $pluginId]);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('service.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Service $service)
    {
        return DeleteResourceAction::make($service);
    }

    public function category($category)
    {
        $categoryModel = ServiceCategory::where('slug', $category)->first();

        // Support translated category slug
        if (! $categoryModel && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
            try {
                $locale = Language::getCurrentLocaleCode();

                $categoryModel = ServiceCategory::query()
                    ->whereHas('translations', function ($query) use ($locale, $category) {
                        $query
                            ->where('lang_code', $locale)
                            ->where('slug', $category);
                    })
                    ->first();
            } catch (\Throwable) {
                // ignore
            }
        }

        if (! $categoryModel) {
            abort(404);
        }

        $service = $categoryModel
            ->services()
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categoryName = $categoryModel ? $categoryModel->name : null;

        if ($categoryModel && ! empty($categoryModel->description)) {
            $categoryModel->description = do_shortcode($this->normalizeShortcodeMarkup((string) $categoryModel->description));
        }

        return Theme::scope(
            'service-page',
            compact('service', 'categoryName', 'categoryModel'),
            'plugins/service::service-page'
        )
            ->layout('default-no-sidebar')
            ->render();
    }

    public function detail($category, $slug)
    {
        $categoryModel = ServiceCategory::where('slug', $category)->first();

        if (! $categoryModel && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
            try {
                $locale = Language::getCurrentLocaleCode();

                $categoryModel = ServiceCategory::query()
                    ->whereHas('translations', function ($query) use ($locale, $category) {
                        $query
                            ->where('lang_code', $locale)
                            ->where('slug', $category);
                    })
                    ->first();
            } catch (\Throwable) {
                // ignore
            }
        }

        if (! $categoryModel) {
            abort(404);
        }

        $serviceQuery = Service::query()
            ->where('status', 'published')
            ->where(function ($query) use ($slug) {
                $query->where('link', $slug);

                // Support translated service link
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

        $serviceQuery->whereHas('categories', function ($q) use ($categoryModel) {
            $q->whereKey($categoryModel->getKey());
        });

        $service = $serviceQuery->firstOrFail();

        $service->content = do_shortcode($this->normalizeShortcodeMarkup((string) ($service->content ?? '')));

        return Theme::scope(
            'service-detail-page',
            compact('service'),
            'plugins/service::service-detail-page'
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
