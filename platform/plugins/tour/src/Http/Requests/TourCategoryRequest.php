<?php

namespace Botble\Tour\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TourCategoryRequest extends Request
{
    public function rules(): array
    {
        // Determine current category id from any route parameter (robust for different param names)
        $ignoreId = null;
        $route = $this->route();
        if ($route) {
            foreach ($route->parameters() as $p) {
                if ($p instanceof \Botble\Tour\Models\TourCategory) {
                    $ignoreId = $p->getKey();
                    break;
                }
                if ($p instanceof \Illuminate\Database\Eloquent\Model) {
                    try {
                        if (method_exists($p, 'getTable') && $p->getTable() === 'tour_categories') {
                            $ignoreId = $p->getKey();
                            break;
                        }
                    } catch (\Throwable $e) {
                        // ignore
                    }
                }
            }
        }

        $pluginId = function_exists('tour_plugin_id')
            ? tour_plugin_id()
            : 'al/tour';

        return [
            'name' => ['required', 'string', 'max:220'],
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('tour_categories', 'id')->where('plugin_id', $pluginId),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\\-]+$/',
                Rule::unique('tour_categories', 'slug')
                    ->ignore($ignoreId)
                    ->where('plugin_id', $pluginId),
            ],
            'description' => ['nullable', 'string'],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => trans('plugins/tour::tour.validation.category_slug_regex'),
            'slug.unique' => trans('plugins/tour::tour.validation.category_slug_unique'),
        ];
    }
}
