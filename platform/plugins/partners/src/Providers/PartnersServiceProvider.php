<?php

namespace Botble\Partners\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Partners\Models\Partners;

class PartnersServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/partners')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();

        // if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
        //     \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Partners::class, [
        //         'name',
        //     ]);
        // }

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::registerItem([
                'id' => 'cms-plugins-partners',
                'priority' => 6,
                'parent_id' => null,
                'name' => 'plugins/partners::partners.name',
                'icon' => 'fas fa-handshake',
                'url' => route('partners.index'),
                'permissions' => ['partners.index'],
            ]);
        });
    }
}
