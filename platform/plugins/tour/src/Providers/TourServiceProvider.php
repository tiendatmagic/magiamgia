<?php

namespace Botble\Tour\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Language\Facades\Language;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Setting\Facades\Setting;
use Botble\Slug\Facades\SlugHelper;
use Botble\Tour\Models\Tour;
use Botble\Tour\Models\TourCategory;
use Illuminate\Support\Str;

class TourServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    protected function seedPermalinkPrefixes(): void
    {
        $key = 'permalink-' . Str::slug(str_replace('\\', '_', Tour::class));

        $supportedLocales = [];
        $defaultLocale = null;

        if (function_exists('is_plugin_active') && is_plugin_active('language')) {
            try {
                $supportedLocales = array_keys(Language::getSupportedLocales());
                $defaultLocale = Language::getDefaultLocaleCode();
            } catch (\Throwable) {
                $supportedLocales = [];
                $defaultLocale = null;
            }
        }

        if (empty($supportedLocales)) {
            $supportedLocales = [app()->getLocale()];
            $defaultLocale = app()->getLocale();
        }

        $defaultLocale = $defaultLocale ?: $supportedLocales[0];

        $shouldSave = false;

        foreach ($supportedLocales as $locale) {
            $value = function_exists('tour_default_slug_prefix')
                ? tour_default_slug_prefix($locale)
                : 'tour';
            $settingKey = $locale !== $defaultLocale ? ($key . '-' . $locale) : $key;

            if (! Setting::has($settingKey)) {
                Setting::set($settingKey, $value);
                $shouldSave = true;
            }
        }

        if ($shouldSave) {
            Setting::save();
        }
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/tour')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();

        if (class_exists(SlugHelper::class)) {
            SlugHelper::registerModule(Tour::class, trans('plugins/tour::tour.name'));

            // Seed defaults so after activating plugin:
            // - vi => dich-vu
            // - en => tour
            // and users can edit per-language in /admin/settings/permalink.
            $this->seedPermalinkPrefixes();
        }

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Tour::class, [
                'name',
                'intro',
                'content',
                'policy',
                'link',
            ]);

            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(TourCategory::class, [
                'name',
                'slug',
                'description',
            ]);
        }

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-tour',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/tour::tour.name',
                'icon' => 'ti ti-box',
                'permissions' => ['tour.index'],
            ]);
        });

        DashboardMenu::registerItem([
            'id' => 'cms-plugins-tour-subpage',
            'priority' => 1,
            'parent_id' => 'cms-plugins-tour',
            'name' => 'plugins/tour::tour.subpage',
            'icon' => 'ti ti-file-text',
            'url' => fn() => route('tour.index'),
            'permissions' => ['tour.index'],
        ]);

        DashboardMenu::registerItem([
            'id' => 'cms-plugins-tour-category',
            'priority' => 2,
            'parent_id' => 'cms-plugins-tour',
            'name' => 'plugins/tour::tour.category',
            'icon' => 'ti ti-list',
            'url' => fn() => route('tour-category.index'),
            'permissions' => ['tour-category.index'],
        ]);

        try {
            \Botble\CustomField\Facades\CustomField::registerModule(Tour::class);
        } catch (\Throwable $e) {
            // ignore if custom-field not available yet
        }

        $this->app->booted(function () {
            SeoHelper::registerModule([Tour::class]);

            $this->app->register(HookServiceProvider::class);
        });
    }
}
