<?php

namespace Botble\Voucher\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

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
    'show_homepage_hot',
  ];

  protected $casts = [
    'status' => BaseStatusEnum::class,
    'note' => SafeContent::class,
    'expired_at' => 'datetime',
    'is_hot' => 'boolean',
    'show_homepage_hot' => 'boolean',
  ];

  protected $appends = ['discount_type_label'];

  public function getDiscountTypeLabelAttribute(): string
  {
    $types = voucher_discount_types();

    $type = $this->attributes['discount_type'] ?? 'percent';

    return $types[$type] ?? $types['percent'];
  }

  public function setIsHotAttribute($value)
  {
    $this->attributes['is_hot'] = (int) filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }

  public function setShowHomepageHotAttribute($value)
  {
    $this->attributes['show_homepage_hot'] = (int) filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }

  /**
   * Set the expired_at attribute
   * Accepts both date strings (YYYY-MM-DD) and datetime strings
   * Date-only strings are set to START of day (00:00:00)
   */
  public function setExpiredAtAttribute($value)
  {
    if (!$value) {
      $this->attributes['expired_at'] = null;
      return;
    }

    try {
      // If value is a Carbon instance
      if ($value instanceof Carbon) {
        $this->attributes['expired_at'] = $value->toDateTimeString();
      }
      // If value is a string
      elseif (is_string($value)) {
        // If only date (YYYY-MM-DD), append 00:00:00
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
          $this->attributes['expired_at'] = $value . ' 00:00:00';
        }
        // If datetime format (YYYY-MM-DD HH:MM:SS), use as-is
        elseif (preg_match('/^\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}$/', $value)) {
          $this->attributes['expired_at'] = $value;
        }
        // Parse other formats with Carbon
        else {
          $carbon = Carbon::parse($value, 'Asia/Ho_Chi_Minh');
          $this->attributes['expired_at'] = $carbon->toDateTimeString();
        }
      } else {
        $carbon = Carbon::parse($value, 'Asia/Ho_Chi_Minh');
        $this->attributes['expired_at'] = $carbon->toDateTimeString();
      }
    } catch (\Exception $e) {
      $this->attributes['expired_at'] = null;
    }
  }

  public function provider(): BelongsTo
  {
    return $this->belongsTo(Provider::class, 'provider_id');
  }
}
