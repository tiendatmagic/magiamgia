<?php

namespace Botble\Service\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ServiceCategoryRequest extends Request
{
    public function rules(): array
    {
        // Determine current category id from any route parameter (robust for different param names)
        $ignoreId = null;
        $route = $this->route();
        if ($route) {
            foreach ($route->parameters() as $p) {
                if ($p instanceof \Botble\Service\Models\ServiceCategory) {
                    $ignoreId = $p->getKey();
                    break;
                }
                if ($p instanceof \Illuminate\Database\Eloquent\Model) {
                    try {
                        if (method_exists($p, 'getTable') && $p->getTable() === 'service_categories') {
                            $ignoreId = $p->getKey();
                            break;
                        }
                    } catch (\Throwable $e) {
                        // ignore
                    }
                }
            }
        }

        $pluginId = function_exists('service_plugin_id')
            ? service_plugin_id()
            : 'al/service';

        return [
            'name' => ['required', 'string', 'max:220'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\\-]+$/',
                Rule::unique('service_categories', 'slug')
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
            'slug.regex' => 'Slug chỉ được chứa chữ, số và dấu gạch ngang (-). Không được chứa khoảng trắng hoặc ký tự đặc biệt.',
            'slug.unique' => 'Slug đã tồn tại. Vui lòng nhập slug khác.',
        ];
    }
}
