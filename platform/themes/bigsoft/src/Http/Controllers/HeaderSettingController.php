<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class HeaderSettingController extends BaseController
{
    public function index()
    {
        $this->pageTitle(__('Header'));

        return view(Theme::getThemeNamespace('views.admin.header-settings'));
    }

    public function update(Request $request)
    {
        ThemeOption::checkOptName();

        $keys = [
            'header_layout',
            'header_background_color',
            'header_search_style',
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
