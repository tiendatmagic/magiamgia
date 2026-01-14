<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Base\Http\Middleware\RequiresJsonRequestMiddleware;
use Botble\Voucher\Http\Controllers\ProviderController;
use Botble\Voucher\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
  $pluginId = trim((string) voucher_plugin_id(), '/');
  $pos = strrpos($pluginId, '/');
  $pluginPrefix = $pos === false ? $pluginId : substr($pluginId, $pos + 1);

  // Redirect base voucher URL to providers
  Route::get($pluginPrefix, function () {
    return redirect()->route('voucher-provider.index');
  });

  Route::group(['prefix' => $pluginPrefix . '/providers', 'as' => 'voucher-provider.'], function () {
    Route::resource('', ProviderController::class)->parameters(['' => 'provider']);
    Route::get('{provider}/categories', [ProviderController::class, 'categories'])
      ->name('categories');
  });

  Route::group(['prefix' => $pluginPrefix . '/coupons', 'as' => 'voucher-coupon.'], function () {
    Route::resource('', VoucherController::class)->parameters(['' => 'voucher']);
  });
});

// Public ajax routes
if (defined('THEME_MODULE_SCREEN_NAME')) {
  \Botble\Theme\Facades\Theme::registerRoutes(function () {
    Route::get('{slug}', [PublicController::class, 'show'])
      ->name('public.providers.show');

    Route::middleware(RequiresJsonRequestMiddleware::class)
      ->get('ajax/voucher/load-more', [VoucherController::class, 'loadMore'])
      ->name('public.ajax.voucher.load-more');
  });
}
