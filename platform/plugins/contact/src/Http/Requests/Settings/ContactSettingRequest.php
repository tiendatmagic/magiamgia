<?php

namespace Botble\Contact\Http\Requests\Settings;

use Botble\Support\Http\Requests\Request;

class ContactSettingRequest extends Request
{
    public function rules(): array
    {
        return apply_filters('contact_settings_validation_rules', [
            'blacklist_keywords' => ['nullable', 'string'],
        ]);
    }
}
