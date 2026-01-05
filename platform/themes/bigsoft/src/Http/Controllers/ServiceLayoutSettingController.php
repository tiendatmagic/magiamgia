<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class ServiceLayoutSettingController extends BaseController
{
    public function index()
    {
        $this->pageTitle(__('Service layout'));

        return view(Theme::getThemeNamespace('views.admin.service-layout-settings'));
    }

    public function update(Request $request)
    {
        ThemeOption::checkOptName();

        $keys = [
            'service_layout',
            'service_detail_layout',
            'service_grid_cols',
            'service_grid_cols_sm',
            'service_grid_cols_md',
            'service_grid_cols_lg',
            'service_grid_cols_xl',
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
