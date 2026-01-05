<?php

namespace Theme\BigSoft\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Facades\ThemeOption;
use Illuminate\Http\Request;

class FooterSettingController extends BaseController
{
    public function index()
    {
        $this->pageTitle('footer');

        return view(Theme::getThemeNamespace('views.admin.footer-settings'));
    }

    public function update(Request $request)
    {
        ThemeOption::checkOptName();

        $keys = [
            'copyright',
            'footer_image',
            'footer_description',
            'text_footer_social',
            'name_address',
            'address',
            'name_address2',
            'address2',
            'contact_phone',
            'contact_email',
            'working_hours',
            'website',
            'footer_background_color_from',
            'footer_background_color_to',
            'footer_copyright_alignment',
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
