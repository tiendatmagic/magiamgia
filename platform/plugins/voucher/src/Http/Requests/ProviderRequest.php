<?php

namespace Botble\Voucher\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ProviderRequest extends Request
{
  protected function prepareForValidation(): void
  {
    $hasSplit = $this->has('accordions_header') || $this->has('accordions_footer');

    if (! $hasSplit) {
      return;
    }

    $headerRaw = $this->input('accordions_header');
    $footerRaw = $this->input('accordions_footer');

    $header = is_string($headerRaw) ? json_decode($headerRaw, true) : [];
    $footer = is_string($footerRaw) ? json_decode($footerRaw, true) : [];

    if (! is_array($header)) {
      $header = [];
    }

    if (! is_array($footer)) {
      $footer = [];
    }

    $this->merge([
      'accordions' => json_encode([
        'header' => $header,
        'footer' => $footer,
      ]),
    ]);
  }

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
      'accordions_header' => 'nullable|string',
      'accordions_footer' => 'nullable|string',
      'accordions' => 'nullable|string',
      'status' => 'required|string',
    ];
  }
}
