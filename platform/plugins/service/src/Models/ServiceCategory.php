<?php

namespace Botble\Service\Models;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Collection;

class ServiceCategory extends BaseModel
{
    protected $table = 'service_categories';

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

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(
            Service::class,
            'service_service_categories',
            'service_category_id',
            'service_id'
        )
            ->wherePivot('plugin_id', service_plugin_id());
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
            $query->where($query->getModel()->getTable() . '.plugin_id', service_plugin_id());
        });

        static::saving(function ($model) {
            if (empty($model->plugin_id)) {
                $model->plugin_id = service_plugin_id();
            }

            if (empty($model->slug) && ! empty($model->name)) {
                $slug = \Illuminate\Support\Str::slug($model->name);
                $original = $slug;
                $i = 1;

                while (self::query()
                    ->where('plugin_id', service_plugin_id())
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

            return url('/' . $this->slug);
        });
    }
}
