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
    'coupon_image',
    'expired_at',
    'status',
    'is_hot',
  ];

  protected $casts = [
    'status' => BaseStatusEnum::class,
    'note' => SafeContent::class,
    'expired_at' => 'date',
    'is_hot' => 'boolean',
  ];

  protected $appends = ['discount_type_label'];

  public function getDiscountTypeLabelAttribute()
  {
    return trans('plugins/voucher::voucher.discount.' . $this->attributes['discount_type'] ?? 'percent');
  }

  public function setIsHotAttribute($value)
  {
    $this->attributes['is_hot'] = ($value === 'on' || $value === true || $value === 1) ? 1 : 0;
  }

  protected static function booted()
  {
    static::saving(function ($model) {
      if (!isset($model->attributes['is_hot'])) {
        $model->attributes['is_hot'] = 0;
      }
    });
  }

  public function provider(): BelongsTo
  {
    return $this->belongsTo(Provider::class, 'provider_id');
  }
}
