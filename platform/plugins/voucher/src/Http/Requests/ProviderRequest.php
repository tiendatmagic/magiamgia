<?php

namespace Botble\Voucher\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ProviderRequest extends Request
{
  public function rules(): array
  {
    return [
      'name' => 'required|string|max:250',
      'slug' => ['nullable', 'string', 'max:250', 'regex:/^[A-Za-z0-9-]+$/'],
      'logo' => 'nullable|string|max:250',
      'button_1_text' => 'nullable|string|max:250',
      'button_1_url' => 'nullable|string|max:2048',
      'button_2_text' => 'nullable|string|max:250',
      'button_2_url' => 'nullable|string|max:2048',
      'tags' => 'nullable|string',
      'accordions' => 'nullable|string',
      'status' => 'required|string',
    ];
  }
}
