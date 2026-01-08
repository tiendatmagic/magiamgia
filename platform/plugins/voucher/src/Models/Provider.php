<?php

namespace Botble\Voucher\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Slug\Models\Slug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Provider extends BaseModel
{
  protected $table = 'bng_voucher_providers';

  protected $fillable = [
    'name',
    'logo',
    'description',
    'button_1_text',
    'button_1_url',
    'button_2_text',
    'button_2_url',
    'tags',
    'accordions',
    'status',
  ];

  protected $casts = [
    'status' => BaseStatusEnum::class,
    'name' => SafeContent::class,
    'description' => SafeContent::class,
    'tags' => 'array',
    'accordions' => 'array',
  ];

  public function slugable(): MorphOne
  {
    return $this->morphOne(Slug::class, 'reference')->select([
      'id',
      'key',
      'reference_type',
      'reference_id',
      'prefix',
    ]);
  }

  public function vouchers(): HasMany
  {
    return $this->hasMany(Voucher::class, 'provider_id');
  }

  public function getSlugAttribute(): string
  {
    return $this->slugable ? $this->slugable->key : '';
  }

  protected function tags(): Attribute
  {
    return Attribute::make(
      set: function ($value) {
        if (is_array($value)) {
          $tags = $value;
        } elseif (is_string($value)) {
          $raw = str_replace(['\n', '\r', ';'], [',', '', ','], $value);
          $tags = array_map('trim', explode(',', $raw));
        } else {
          $tags = [];
        }

        $tags = array_values(array_filter(array_map('strval', $tags)));

        return $tags ? json_encode($tags) : null;
      }
    );
  }

  protected function accordions(): Attribute
  {
    return Attribute::make(
      set: function ($value) {
        if (is_array($value)) {
          return $value ? json_encode($value) : null;
        }

        if (is_string($value)) {
          $value = trim($value);
          return $value !== '' ? $value : null;
        }

        return null;
      }
    );
  }
}
