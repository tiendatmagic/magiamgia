<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class NotFoundPageSettingController extends BaseController
{
    public function index()
    {
        $this->pageTitle(__('404'));

        return view(Theme::getThemeNamespace('views.admin.404-settings'));
    }

    public function update(Request $request)
    {
        ThemeOption::checkOptName();

        $keys = [
            '404_page_title',
            '404_page_content',
            '404_page_image',
        ];

        foreach ($keys as $key) {
            ThemeOption::setOption($key, $request->input($key));
        }

        ThemeOption::saveOptions();

        if ($request->expectsJson()) {
            return $this->httpResponse()->withUpdatedSuccessMessage();
        }

        return redirect()
            ->back()
            ->with('success_msg', trans('core/base::notices.update_success_message'));
    }
}
