<?php

namespace Botble\Member\Http\Controllers;

use Botble\ACL\Traits\SendsPasswordResetEmails;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Member\Forms\Fronts\Auth\ForgotPasswordForm;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends BaseController
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        SeoHelper::setTitle(trans('plugins/member::member.forgot_password'));

        return Theme::scope(
            'member.auth.passwords.email',
            ['form' => ForgotPasswordForm::create()],
            'plugins/member::themes.auth.passwords.email'
        )->render();
    }

    public function broker()
    {
        return Password::broker('members');
    }
}
