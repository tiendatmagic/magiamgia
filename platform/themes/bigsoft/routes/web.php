<?php

use App\Http\Controllers\Controller;
use Botble\Base\Facades\AdminHelper;
use Botble\Base\Http\Middleware\RequiresJsonRequestMiddleware;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use Theme\BigSoft\Http\Controllers\BigsoftController;
use Theme\BigSoft\Http\Controllers\BlogLayoutSettingController;
use Theme\BigSoft\Http\Controllers\FooterSettingController;
use Theme\BigSoft\Http\Controllers\HeaderSettingController;
use Theme\BigSoft\Http\Controllers\NotFoundPageSettingController;
use Theme\BigSoft\Http\Controllers\ServiceLayoutSettingController;

Theme::registerRoutes(function () {

    // Ajax search
    Route::group(['controller' => BigsoftController::class], function () {
        Route::middleware(RequiresJsonRequestMiddleware::class)
            ->get('ajax/search', 'getSearch')
            ->name('public.ajax.search');
    });

    // Route blog post
    Route::get('{slug}.html', function ($slug) {
        return (new PublicController)->getView($slug);
    })->where('slug', '[^/.]+');

    Route::get('{slug}', function ($slug) {
        return (new PublicController)->getView($slug);
    })->where('slug', '[^/.]+');

    Route::post('/contact', [Controller::class, 'sendContact']);
    Route::post('/booking', [Controller::class, 'sendBooking']);
});

Theme::routes();

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'theme/header'], function () {
        Route::get('', [HeaderSettingController::class, 'index'])
            ->name('theme.header')
            ->defaults('permission', 'theme.options');

        Route::post('', [HeaderSettingController::class, 'update'])
            ->name('theme.header.update')
            ->defaults('permission', 'theme.options');
    });

    Route::group(['prefix' => 'theme/footer'], function () {
        Route::get('', [FooterSettingController::class, 'index'])
            ->name('theme.footer')
            ->defaults('permission', 'theme.options');

        Route::post('', [FooterSettingController::class, 'update'])
            ->name('theme.footer.update')
            ->defaults('permission', 'theme.options');
    });

    Route::group(['prefix' => 'theme/blog-layout'], function () {
        Route::get('', [BlogLayoutSettingController::class, 'index'])
            ->name('theme.blog-layout')
            ->defaults('permission', 'theme.options');

        Route::post('', [BlogLayoutSettingController::class, 'update'])
            ->name('theme.blog-layout.update')
            ->defaults('permission', 'theme.options');
    });

    if (function_exists('is_plugin_active') && is_plugin_active('bigsoft-service')) {
        Route::group(['prefix' => 'theme/service-layout'], function () {
            Route::get('', [ServiceLayoutSettingController::class, 'index'])
                ->name('theme.service-layout')
                ->defaults('permission', 'theme.options');

            Route::post('', [ServiceLayoutSettingController::class, 'update'])
                ->name('theme.service-layout.update')
                ->defaults('permission', 'theme.options');
        });
    }

    Route::group(['prefix' => 'theme/404'], function () {
        Route::get('', [NotFoundPageSettingController::class, 'index'])
            ->name('theme.404')
            ->defaults('permission', 'theme.options');

        Route::post('', [NotFoundPageSettingController::class, 'update'])
            ->name('theme.404.update')
            ->defaults('permission', 'theme.options');
    });
});
