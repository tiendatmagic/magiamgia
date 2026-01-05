<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Service\Models\ServiceCategory;

if (! function_exists('service_plugin_id')) {
	function service_plugin_id(): string
	{
		try {
			if (function_exists('plugin_path')) {
				$jsonPath = plugin_path('service/plugin.json');

				if (\Illuminate\Support\Facades\File::exists($jsonPath)) {
					$content = \Botble\Base\Facades\BaseHelper::getFileData($jsonPath);

					$id = (string) ($content['id'] ?? '');
					if ($id !== '') {
						return $id;
					}
				}
			}
		} catch (\Throwable) {
			// ignore
		}

		return 'al/service';
	}
}

if (! function_exists('get_service_categories_with_children')) {
	function get_service_categories_with_children(): array
	{
		$categories = ServiceCategory::query()
			->where('status', BaseStatusEnum::PUBLISHED)
			->select(['id', 'name', 'parent_id'])
			->get();

		return app(SortItemsWithChildrenHelper::class)
			->setChildrenProperty('child_cats')
			->setItems($categories)
			->sort();
	}
}
