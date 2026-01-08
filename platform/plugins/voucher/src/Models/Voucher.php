<?php

namespace Botble\Voucher\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends BaseModel
{
  protected $table = 'bng_vouchers';

  protected $fillable = [
    'provider_id',
    'category',
    'code',
    'discount_type',
    'discount_value',
    'max_discount',
    'min_order',
    'note',
    'apply_url',
    'banner_url',
    'expired_at',
    'status',
  ];

  protected $casts = [
    'status' => BaseStatusEnum::class,
    'note' => SafeContent::class,
    'expired_at' => 'date',
  ];

  public function getDiscountTypeAttribute($value)
  {
    return trans('plugins/voucher::voucher.discount.' . $value);
  }

  public function provider(): BelongsTo
  {
    return $this->belongsTo(Provider::class, 'provider_id');
  }
}
