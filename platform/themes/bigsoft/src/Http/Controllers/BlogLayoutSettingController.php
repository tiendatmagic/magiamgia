<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class BlogLayoutSettingController extends BaseController
{
    public function index()
    {
        $this->pageTitle(__('Blog layout'));

        return view(Theme::getThemeNamespace('views.admin.blog-layout-settings'));
    }

    public function update(Request $request)
    {
        ThemeOption::checkOptName();

        $keys = [
            'blog_layout',
            'post_layout',
            'blog_grid_cols',
            'blog_grid_cols_sm',
            'blog_grid_cols_md',
            'blog_grid_cols_lg',
            'blog_grid_cols_xl',
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
