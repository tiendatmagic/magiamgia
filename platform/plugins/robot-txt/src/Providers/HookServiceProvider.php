<?php

namespace Botble\RobotTxt\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugins/robot-txt');

    DashboardMenu::default()->beforeRetrieving(function () {
      DashboardMenu::registerItem([
        'id' => 'cms-core-robot-txt',
        'priority' => 999999,
        'parent_id' => 'cms-core-appearance',
        'name' => 'plugins/robot-txt::robot-txt.title',
        'icon' => 'ti ti-robot',
        'url' => fn() => route('robot-txt.settings'),
        'permissions' => ['robot-txt.settings'],
      ]);
    });
  }
}
