<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class HomeSettingController extends BaseController
{
  public function index()
  {
    $this->pageTitle(__('Home Page Settings'));

    $homeTitle = ThemeOption::getOption('home_title', 'Nhà cung cấp nổi bật');
    $homeDescription = ThemeOption::getOption('home_description', '');
    $homeSliders = json_decode(ThemeOption::getOption('home_sliders', '[]'), true) ?: [];

    return view(Theme::getThemeNamespace('views.admin.home-settings'), compact('homeTitle', 'homeDescription', 'homeSliders'));
  }

  public function update(Request $request)
  {
    ThemeOption::checkOptName();

    $keys = [
      'home_title',
      'home_description',
    ];

    foreach ($keys as $key) {
      ThemeOption::setOption($key, $request->input($key));
    }

    // Xử lý slider data
    $sliders = $request->input('home_sliders', []);
    $slidersData = [];
    if (is_array($sliders)) {
      foreach ($sliders as $slider) {
        if (!empty($slider['image']) || !empty($slider['url'])) {
          $slidersData[] = [
            'image' => $slider['image'] ?? '',
            'url' => $slider['url'] ?? '',
          ];
        }
      }
    }

    ThemeOption::setOption('home_sliders', json_encode($slidersData));
    ThemeOption::saveOptions();

    if ($request->expectsJson()) {
      return $this->httpResponse()->withUpdatedSuccessMessage();
    }

    return redirect()
      ->back()
      ->with('success_msg', trans('core/base::notices.update_success_message'));
  }
}
