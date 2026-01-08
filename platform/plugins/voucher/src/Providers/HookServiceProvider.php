<?php

namespace Botble\Voucher\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Menu\Events\RenderingMenuOptions;
use Botble\Menu\Facades\Menu;
use Botble\Slug\Models\Slug;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Services\VoucherService;
use Illuminate\Support\Facades\Auth;

class HookServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    Menu::addMenuOptionModel(Provider::class);

    $this->app['events']->listen(RenderingMenuOptions::class, function () {
      add_action(MENU_ACTION_SIDEBAR_OPTIONS, [$this, 'registerMenuOptions'], 2);
    });

    add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 25);
  }

  public function registerMenuOptions(): void
  {
    if (Auth::guard()->check() && Auth::guard()->user()->hasPermission('voucher-provider.index')) {
      Menu::registerMenuOptions(
        Provider::class,
        trans('plugins/voucher::voucher.providers')
      );
    }
  }

  public function handleSingleView(Slug|array $slug): Slug|array
  {
    return (new VoucherService())->handleFrontRoutes($slug);
  }
}
