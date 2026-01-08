<?php

namespace Botble\Tour\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TourRequest extends Request
{
    public function rules(): array
    {
        $ignoreId = null;
        $route = $this->route();
        if ($route) {
            foreach ($route->parameters() as $p) {
                if ($p instanceof \Botble\Tour\Models\Tour) {
                    $ignoreId = $p->getKey();
                    break;
                }
                if ($p instanceof \Illuminate\Database\Eloquent\Model) {
                    try {
                        if (method_exists($p, 'getTable') && $p->getTable() === 'tours') {
                            $ignoreId = $p->getKey();
                            break;
                        }
                    } catch (\Throwable $e) {
                    }
                }
            }
        }

        $pluginId = function_exists('tour_plugin_id')
            ? tour_plugin_id()
            : 'al/tour';

        return [
            'name' => ['required', 'string', 'max:220'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => [
                'required',
                'integer',
                Rule::exists('tour_categories', 'id')->where('plugin_id', $pluginId),
            ],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
            'departure_time' => ['nullable', 'string', 'max:255'],
            'vehicle' => ['nullable', 'string', 'max:255'],
            'original_price' => ['nullable', 'integer', 'min:0'],
            'adult_price' => ['nullable', 'integer', 'min:0'],
            'child_price' => ['nullable', 'integer', 'min:0'],
            'attachment' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'policy' => ['nullable', 'string'],
            'created_at' => ['nullable', 'date_format:d/m/Y'],
            'link' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\\-]+$/',
                Rule::unique('tours', 'link')
                    ->ignore($ignoreId)
                    ->where('plugin_id', $pluginId),
            ],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }

    public function messages(): array
    {
        return [
            'link.regex' => trans('plugins/tour::tour.validation.tour_link_regex'),
            'link.unique' => trans('plugins/tour::tour.validation.tour_link_unique'),
        ];
    }
}
