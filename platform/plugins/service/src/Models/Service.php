<?php

namespace Botble\Service\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Service extends BaseModel
{
    protected $table = 'services';

    protected $fillable = [
        'plugin_id',
        'name',
        'image',
        'content',
        'link',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ServiceCategory::class,
            'service_service_categories',
            'service_id',
            'service_category_id'
        )
            ->wherePivot('plugin_id', service_plugin_id());
    }

    protected static function booted()
    {
        static::addGlobalScope('plugin_id', function ($query) {
            $query->where($query->getModel()->getTable().'.plugin_id', service_plugin_id());
        });

        static::saving(function ($service) {
            if (empty($service->plugin_id)) {
                $service->plugin_id = service_plugin_id();
            }

            if (empty($service->link) && ! empty($service->name)) {
                $slug = Str::slug($service->name);
                $originalSlug = $slug;
                $i = 1;

                while (self::query()
                    ->where('plugin_id', service_plugin_id())
                    ->where('link', $slug)
                    ->when($service->getKey(), fn ($q) => $q->where('id', '!=', $service->getKey()))
                    ->exists()
                ) {
                    $slug = $originalSlug.'-'.$i;
                    $i++;
                }

                $service->link = $slug;
            }
        });
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->link) {
                return url('/');
            }

            $categorySlug = $this->categories()->value('slug');

            if (! $categorySlug) {
                return url('/'.$this->link);
            }

            return url('/'.$categorySlug.'/'.$this->link);
        });
    }
}
