<?php

namespace Botble\Voucher\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Voucher\Models\Provider;

class VoucherServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;

  public function boot(): void
  {
    $this
      ->setNamespace('plugins/voucher')
      ->loadHelpers()
      ->loadAndPublishConfigurations(['permissions'])
      ->loadAndPublishTranslations()
      ->loadRoutes()
      ->loadAndPublishViews()
      ->loadMigrations()
      ->publishAssets();

    if (class_exists(SlugHelper::class)) {
    }

    DashboardMenu::default()->beforeRetrieving(function () {
      DashboardMenu::registerItem([
        'id' => 'cms-plugins-voucher',
        'priority' => 5,
        'parent_id' => null,
        'name' => 'plugins/voucher::voucher.name',
        'icon' => 'ti ti-ticket',
        'permissions' => ['voucher.index'],
      ]);
    });

    DashboardMenu::registerItem([
      'id' => 'cms-plugins-voucher-provider',
      'priority' => 1,
      'parent_id' => 'cms-plugins-voucher',
      'name' => 'plugins/voucher::voucher.providers',
      'icon' => 'ti ti-building-store',
      'url' => fn() => route('voucher-provider.index'),
      'permissions' => ['voucher-provider.index'],
    ]);

    DashboardMenu::registerItem([
      'id' => 'cms-plugins-voucher-coupon',
      'priority' => 2,
      'parent_id' => 'cms-plugins-voucher',
      'name' => 'plugins/voucher::voucher.coupons',
      'icon' => 'ti ti-tags',
      'url' => fn() => route('voucher-coupon.index'),
      'permissions' => ['voucher-coupon.index'],
    ]);

    $this->app->booted(function () {
      SeoHelper::registerModule([Provider::class]);

      $this->app->register(HookServiceProvider::class);
    });
  }
}
