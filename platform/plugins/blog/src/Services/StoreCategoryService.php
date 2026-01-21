<?php

namespace Botble\Blog\Services;

use Botble\Blog\Models\Post;
use Botble\Blog\Services\Abstracts\StoreCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreCategoryService extends StoreCategoryServiceAbstract
{
    public function execute(Request $request, Post $post): void
    {
        $categories = $request->input('categories', []);

        if (empty($categories)) {
            if (class_exists(\Botble\Blog\Models\Category::class)) {
                $default = \Botble\Blog\Models\Category::query()->where('is_default', 1)->first();
                if ($default) {
                    $categories = [$default->id];
                }
            }
        }

        $post->categories()->sync($categories);
    }
}
