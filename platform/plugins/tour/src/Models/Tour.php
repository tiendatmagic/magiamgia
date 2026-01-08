<?php

namespace Botble\Tour\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Slug\Models\Slug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Tour extends BaseModel
{
    protected $table = 'tours';

    protected $fillable = [
        'plugin_id',
        'name',
        'image',
        'images',
        'location',
        'duration',
        'departure_time',
        'vehicle',
        'original_price',
        'adult_price',
        'child_price',
        'attachment',
        'intro',
        'content',
        'policy',
        'link',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'images' => 'json',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            TourCategory::class,
            'tour_tour_categories',
            'tour_id',
            'tour_category_id'
        )
            ->wherePivot('plugin_id', tour_plugin_id());
    }

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

    protected static function booted()
    {
        static::addGlobalScope('plugin_id', function ($query) {
            $query->where($query->getModel()->getTable().'.plugin_id', tour_plugin_id());
        });

        static::saving(function ($tour) {
            if (empty($tour->plugin_id)) {
                $tour->plugin_id = tour_plugin_id();
            }

            if (empty($tour->link) && ! empty($tour->name)) {
                $slug = Str::slug($tour->name);
                $originalSlug = $slug;
                $i = 1;

                while (self::query()
                    ->where('plugin_id', tour_plugin_id())
                    ->where('link', $slug)
                    ->when($tour->getKey(), fn ($q) => $q->where('id', '!=', $tour->getKey()))
                    ->exists()
                ) {
                    $slug = $originalSlug.'-'.$i;
                    $i++;
                }

                $tour->link = $slug;
            }
        });
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->link) {
                return url('/');
            }

            $path = function_exists('tour_public_path')
                ? tour_public_path($this->link)
                : ('/tour/'.$this->link);

            if (function_exists('is_plugin_active') && is_plugin_active('language')) {
                return \Botble\Language\Facades\Language::localizeURL($path);
            }

            return url($path);
        });
    }
}
