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
    $homeFaqs = json_decode(ThemeOption::getOption('home_faqs', '[]'), true) ?: [];
    $homeFaqsTitle = ThemeOption::getOption('home_faqs_title', '');
    $homeFaqsDescription = ThemeOption::getOption('home_faqs_description', '');

    $hotVouchersTitle = ThemeOption::getOption('hot_vouchers_title', 'Mã giảm giá hot');
    $hotVouchersDescription = ThemeOption::getOption('hot_vouchers_description', '');

    return view(Theme::getThemeNamespace('views.admin.home-settings'), compact(
      'homeTitle',
      'homeDescription',
      'homeSliders',
      'homeFaqs',
      'homeFaqsTitle',
      'homeFaqsDescription',
      'hotVouchersTitle',
      'hotVouchersDescription'
    ));
  }

  public function update(Request $request)
  {
    ThemeOption::checkOptName();

    $keys = [
      'home_title',
      'home_description',
      'home_faqs_title',
      'home_faqs_description',
      'hot_vouchers_title',
      'hot_vouchers_description',
    ];

    foreach ($keys as $key) {
      $value = $request->has($key) ? $request->input($key) : '';

      if (is_string($value) && $value === $key) {
        $value = '';
      }

      ThemeOption::setOption($key, $value);
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

    // Xử lý FAQ data
    $faqs = $request->input('home_faqs', []);
    $faqsData = [];
    if (is_array($faqs)) {
      foreach ($faqs as $faq) {
        $question = trim($faq['question'] ?? '');
        $answer = trim($faq['answer'] ?? '');
        if ($question !== '' || $answer !== '') {
          $faqsData[] = [
            'question' => $question,
            'answer' => $answer,
          ];
        }
      }
    }

    ThemeOption::setOption('home_faqs', json_encode($faqsData));
    ThemeOption::saveOptions();

    if ($request->expectsJson()) {
      return $this->httpResponse()->withUpdatedSuccessMessage();
    }

    return redirect()
      ->back()
      ->with('success_msg', trans('core/base::notices.update_success_message'));
  }
}