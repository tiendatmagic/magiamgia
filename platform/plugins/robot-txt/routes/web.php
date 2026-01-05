<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\\RobotTxt\\Http\\Controllers'], function () {
  AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'settings'], function () {
      Route::get('robot-txt', [
        'as' => 'robot-txt.settings',
        'uses' => 'Settings\\RobotTxtSettingController@edit',
      ]);

      Route::put('robot-txt', [
        'as' => 'robot-txt.settings.update',
        'uses' => 'Settings\\RobotTxtSettingController@update',
        'permission' => 'robot-txt.settings',
        'middleware' => 'preventDemo',
      ]);
    });
  });
});
