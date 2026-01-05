<?php

namespace Botble\Service\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ServiceRequest extends Request
{
    public function rules(): array
    {
        $ignoreId = null;
        $route = $this->route();
        if ($route) {
            foreach ($route->parameters() as $p) {
                if ($p instanceof \Botble\Service\Models\Service) {
                    $ignoreId = $p->getKey();
                    break;
                }
                if ($p instanceof \Illuminate\Database\Eloquent\Model) {
                    try {
                        if (method_exists($p, 'getTable') && $p->getTable() === 'services') {
                            $ignoreId = $p->getKey();
                            break;
                        }
                    } catch (\Throwable $e) {
                    }
                }
            }
        }

        $pluginId = function_exists('service_plugin_id')
            ? service_plugin_id()
            : 'al/service';

        return [
            'name' => ['required', 'string', 'max:220'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => [
                'required',
                'integer',
                Rule::exists('service_categories', 'id')->where('plugin_id', $pluginId),
            ],
            'link' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\\-]+$/',
                Rule::unique('services', 'link')
                    ->ignore($ignoreId)
                    ->where('plugin_id', $pluginId),
            ],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }

    public function messages(): array
    {
        return [
            'link.regex' => 'Đường dẫn dịch vụ chỉ được chứa chữ, số và dấu gạch ngang (-). Không được chứa khoảng trắng hoặc ký tự đặc biệt.',
            'link.unique' => 'Đường dẫn đã tồn tại. Vui lòng nhập đường dẫn khác.',
        ];
    }
}
