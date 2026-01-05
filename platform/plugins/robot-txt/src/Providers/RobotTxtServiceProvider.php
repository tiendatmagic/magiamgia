<?php

namespace Botble\RobotTxt\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class RobotTxtServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;

  public function boot(): void
  {
    $this
      ->setNamespace('plugins/robot-txt')
      ->loadHelpers()
      ->loadAndPublishConfigurations(['permissions'])
      ->loadRoutes()
      ->loadAndPublishViews()
      ->loadAndPublishTranslations();

    $this->app->booted(function () {
      $this->app->register(HookServiceProvider::class);
    });
  }
}
