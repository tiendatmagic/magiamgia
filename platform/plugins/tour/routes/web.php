<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Tour\Http\Controllers\TourCategoryController;
use Botble\Tour\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    $pluginId = trim((string) tour_plugin_id(), '/');
    $pos = strrpos($pluginId, '/');
    $pluginPrefix = $pos === false ? $pluginId : substr($pluginId, $pos + 1);

    Route::group(['prefix' => $pluginPrefix, 'as' => 'tour.'], function () {
        Route::resource('', TourController::class)->parameters(['' => 'tour']);
    });

    Route::group(['prefix' => $pluginPrefix . '/categories', 'as' => 'tour-category.'], function () {
        Route::resource('', TourCategoryController::class)
            ->parameters(['' => 'tourCategory']);
    });
});

// Public routes
if (defined('THEME_MODULE_SCREEN_NAME')) {
    \Botble\Theme\Facades\Theme::registerRoutes(function () {
        $prefixes = function_exists('tour_all_locales_slug_prefixes')
            ? tour_all_locales_slug_prefixes()
            : ['tour', 'dich-vu'];

        foreach ($prefixes as $prefix) {
            $prefix = trim((string) $prefix, '/');
            if (! $prefix) {
                continue;
            }

            Route::get($prefix, [TourController::class, 'publicIndex']);

            // Handles both:
            // - /{tour-prefix}/{tour-slug}
            // - /{tour-prefix}/{category-slug}
            Route::get($prefix . '/{slug}', [TourController::class, 'publicHandle'])
                ->where('slug', '[A-Za-z0-9\-]+');

            // Itinerary page for a tour: /{tour-prefix}/{tour-slug}/itinerary
            Route::get($prefix . '/{slug}/itinerary', [TourController::class, 'publicItinerary'])
                ->where('slug', '[A-Za-z0-9\-]+');

            // Legacy nested URLs: /{tour-prefix}/{category}/{slug}
            Route::get($prefix . '/{category}/{slug}', [TourController::class, 'publicHandleNested'])
                ->where([
                    'category' => '[A-Za-z0-9\-]+',
                    'slug' => '[A-Za-z0-9\-]+',
                ]);
        }
    });
}
