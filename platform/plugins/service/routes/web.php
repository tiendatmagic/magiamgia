<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Blog\Models\Post;
use Botble\Page\Models\Page;
use Botble\Slug\Models\Slug;
use Botble\Service\Http\Controllers\ServiceCategoryController;
use Botble\Service\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    $pluginId = trim((string) service_plugin_id(), '/');
    $pos = strrpos($pluginId, '/');
    $pluginPrefix = $pos === false ? $pluginId : substr($pluginId, $pos + 1);

    Route::group(['prefix' => $pluginPrefix, 'as' => 'service.'], function () {
        Route::resource('', ServiceController::class)->parameters(['' => 'service']);

    });

    Route::group(['prefix' => $pluginPrefix . '/categories', 'as' => 'service-category.'], function () {
        Route::resource('', ServiceCategoryController::class)
            ->parameters(['' => 'serviceCategory']);
    });

});

// Public routes with automatic locale prefix via Theme
if (defined('THEME_MODULE_SCREEN_NAME')) {
    \Botble\Theme\Facades\Theme::registerRoutes(function () {
        // Avoid catching routes from other plugins (blog tag/category, etc.)
        // Keep regex cache-safe (no DB access during route registration).

        $categoryPattern = '(?!(?:tag|tags|category|categories|search|admin|api)(?:/|$))[A-Za-z0-9\-]+';

        Route::get('{category}', function ($category) {
            return handleServiceCategory($category);
        })->where('category', $categoryPattern);

        Route::get('{category}/{slug}', [ServiceController::class, 'detail'])
            ->where([
                'category' => $categoryPattern,
                'slug' => '[A-Za-z0-9\-]+',
            ]);
    });
}

if (! function_exists('handleServiceCategory')) {
    function handleServiceCategory($category)
    {
        // Kiểm tra xem slug này có phải page/blog khác không
        $slugModel = Slug::where('key', $category)
            ->whereIn('reference_type', [Page::class, Post::class])
            ->first();

        if ($slugModel) {
            if ($slugModel->reference_type === Post::class) {
                return redirect()->route('public.single', $slugModel->key);
            } elseif ($slugModel->reference_type === Page::class) {
                return (new \Botble\Theme\Http\Controllers\PublicController)->getView($slugModel->key);
            }
        }

        $categoryModel = \Botble\Service\Models\ServiceCategory::where('slug', $category)->first();

        // Support translated category slug (Language Advanced)
        if (! $categoryModel && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
            try {
                $locale = \Botble\Language\Facades\Language::getCurrentLocaleCode();

                $categoryModel = \Botble\Service\Models\ServiceCategory::query()
                    ->whereHas('translations', function ($query) use ($locale, $category) {
                        $query
                            ->where('lang_code', $locale)
                            ->where('slug', $category);
                    })
                    ->first();
            } catch (\Throwable) {
                // ignore
            }
        }

        $hasService = false;

        if ($categoryModel) {
            $hasService = $categoryModel
                ->services()
                ->where('status', 'published')
                ->exists();
        }

        if ($hasService || $categoryModel) {
            return app(ServiceController::class)->category($category);
        }

        abort(404);
    }
}
