<?php

namespace Botble\Tour\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Slug\Models\Slug;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;

class TourCategory extends BaseModel
{
    protected $table = 'tour_categories';

    protected $fillable = [
        'plugin_id',
        'name',
        'slug',
        'parent_id',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
    ];

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(
            Tour::class,
            'tour_tour_categories',
            'tour_category_id',
            'tour_id'
        )
            ->wherePivot('plugin_id', tour_plugin_id());
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
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

    /**
     * Used by `core/base::forms.partials.tree-categories-checkbox-options`.
     * The helper builds nested categories using `child_cats`; we expose it as a collection.
     */
    public function getActiveChildrenAttribute(): Collection
    {
        $children = $this->getAttribute('child_cats');

        if ($children instanceof Collection) {
            return $children;
        }

        if (is_array($children)) {
            return collect($children);
        }

        return collect();
    }

    protected static function booted()
    {
        static::addGlobalScope('plugin_id', function ($query) {
            $query->where($query->getModel()->getTable() . '.plugin_id', tour_plugin_id());
        });

        static::saving(function ($model) {
            if (empty($model->plugin_id)) {
                $model->plugin_id = tour_plugin_id();
            }

            if (empty($model->slug) && ! empty($model->name)) {
                $slug = \Illuminate\Support\Str::slug($model->name);
                $original = $slug;
                $i = 1;

                while (self::query()
                    ->where('plugin_id', tour_plugin_id())
                    ->where('slug', $slug)
                    ->when($model->getKey(), fn($q) => $q->where('id', '!=', $model->getKey()))
                    ->exists()
                ) {
                    $slug = $original . '-' . $i++;
                }

                $model->slug = $slug;
            }
        });
    }

    protected function url(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->slug) {
                return url('/');
            }

            $slugs = [];
            $current = $this;
            $guard = 0;

            while ($current && $guard++ < 10) {
                if (! $current->slug) {
                    break;
                }

                array_unshift($slugs, trim((string) $current->slug, '/'));

                if (! $current->parent_id) {
                    break;
                }

                // Avoid lazy-loading loops if relation isn't set
                $current = $current->relationLoaded('parent')
                    ? $current->getRelation('parent')
                    : $current->parent()->first();
            }

            $path = '/' . implode('/', array_filter($slugs));
            $path = function_exists('tour_public_path') ? tour_public_path(ltrim($path, '/')) : $path;

            if (function_exists('is_plugin_active') && is_plugin_active('language')) {
                return \Botble\Language\Facades\Language::localizeURL($path);
            }

            return url($path);
        });
    }
}
