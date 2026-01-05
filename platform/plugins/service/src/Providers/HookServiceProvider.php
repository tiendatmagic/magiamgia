<?php

namespace Botble\Service\Providers;

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\TreeCategoryField;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Supports\ServiceProvider;
use Botble\Language\Facades\Language;
use Botble\Menu\Events\RenderingMenuOptions;
use Botble\Menu\Facades\Menu;
use Botble\Service\Models\Service;
use Botble\Service\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Menu::addMenuOptionModel(ServiceCategory::class);
        Menu::addMenuOptionModel(Service::class);


        $this->app['events']->listen(RenderingMenuOptions::class, function () {
            add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
        });

        // Keep relationship fields visible when editing translations (Language Advanced v2)
        FormAbstract::beforeRendering(function (FormAbstract $form) {
            $model = $form->getModel();

            if (! $model instanceof Service
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
                        ->label('Danh mục dịch vụ')
                        ->choices(get_service_categories_with_children())
                        ->required()
                        ->selected($model->categories()->pluck('service_category_id')->all())
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
                $pluginId = function_exists('service_plugin_id')
                    ? service_plugin_id()
                    : 'al/service';

                if ($data instanceof Service) {
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

                            while (DB::table('services_translations as st')
                                ->join('services as s', 's.id', '=', 'st.services_id')
                                ->where('s.plugin_id', $pluginId)
                                ->where('st.lang_code', $locale)
                                ->where('st.link', $candidate)
                                ->where('st.services_id', '!=', $data->getKey())
                                ->exists()) {
                                $candidate = $base.'-'.$i++;
                            }

                            DB::table('services_translations')
                                ->where([
                                    'lang_code' => $locale,
                                    'services_id' => $data->getKey(),
                                ])
                                ->update(['link' => $candidate]);
                        }
                    }
                }

                if ($data instanceof ServiceCategory) {
                    if ($locale !== Language::getDefaultLocaleCode()) {
                        $slug = (string) $request->input('slug');
                        $name = (string) $request->input('name');

                        if (! $slug && $name) {
                            $base = Str::slug($name);
                            $candidate = $base;
                            $i = 1;

                            while (DB::table('service_categories_translations as ct')
                                ->join('service_categories as c', 'c.id', '=', 'ct.service_categories_id')
                                ->where('c.plugin_id', $pluginId)
                                ->where('ct.lang_code', $locale)
                                ->where('ct.slug', $candidate)
                                ->where('ct.service_categories_id', '!=', $data->getKey())
                                ->exists()) {
                                $candidate = $base.'-'.$i++;
                            }

                            DB::table('service_categories_translations')
                                ->where([
                                    'lang_code' => $locale,
                                    'service_categories_id' => $data->getKey(),
                                ])
                                ->update(['slug' => $candidate]);
                        }
                    }
                }
            }, 1200, 2);
        }
    }

    public function registerMenuOptions(): void
    {
        if (Auth::guard()->user()->hasPermission('service-category.index')) {
            Menu::registerMenuOptions(
                ServiceCategory::class,
                trans('plugins/service::service.category')
            );
        }

        if (Auth::guard()->user()->hasPermission('service.index')) {
            Menu::registerMenuOptions(
                Service::class,
                trans('plugins/service::service.subpage')
            );
        }
    }
}
