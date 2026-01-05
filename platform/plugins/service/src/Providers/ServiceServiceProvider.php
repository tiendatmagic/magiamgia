<?php

namespace Botble\Service\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Service\Models\Service;
use Botble\Service\Models\ServiceCategory;

class ServiceServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/service')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();

        if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Service::class, [
                'name',
                'content',
                'link',
            ]);

            \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(ServiceCategory::class, [
                'name',
                'slug',
                'description',
            ]);
        }

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-service',
                'priority' => 5,
                'parent_id' => null,
                'name' => 'plugins/service::service.name',
                'icon' => 'ti ti-box',
                'permissions' => ['service.index'],
            ]);
        });

        DashboardMenu::registerItem([
            'id' => 'cms-plugins-service-subpage',
            'priority' => 1,
            'parent_id' => 'cms-plugins-service',
            'name' => 'plugins/service::service.subpage',
            'icon' => 'ti ti-file-text',
            'url' => fn () => route('service.index'),
            'permissions' => ['service.index'],
        ]);

        DashboardMenu::registerItem([
            'id' => 'cms-plugins-service-category',
            'priority' => 2,
            'parent_id' => 'cms-plugins-service',
            'name' => 'plugins/service::service.category',
            'icon' => 'ti ti-list',
            'url' => fn () => route('service-category.index'),
            'permissions' => ['service-category.index'],
        ]);

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);
        });
    }
}
