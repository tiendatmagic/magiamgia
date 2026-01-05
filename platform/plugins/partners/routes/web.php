<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Partners\Http\Controllers\PartnersController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'partners', 'as' => 'partners.'], function () {
        Route::resource('', PartnersController::class)->parameters(['' => 'partners']);
    });
});
