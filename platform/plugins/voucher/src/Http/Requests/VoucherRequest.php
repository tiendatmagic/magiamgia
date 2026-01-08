<?php

namespace Botble\Voucher\Http\Requests;

use Botble\Support\Http\Requests\Request;

class VoucherRequest extends Request
{
  public function rules(): array
  {
    return [
      'provider_id' => 'nullable|integer',
      'category' => 'nullable|string|max:250',
      'code' => 'nullable|string|max:250',
      'discount_type' => 'required|in:percent,amount',
      'discount_value' => 'required|numeric|min:0',
      'max_discount' => 'nullable|numeric|min:0',
      'min_order' => 'nullable|numeric|min:0',
      'note' => 'nullable|string',
      'apply_url' => 'nullable|string|max:2048',
      'banner_url' => 'nullable|string|max:2048',
      'expired_at' => 'nullable|date',
      'status' => 'required|string',
    ];
  }
}
