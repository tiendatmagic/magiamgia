<?php

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Rules\MediaImageRule;
use Botble\Blog\Models\Post;
use Botble\Media\Facades\RvMedia;
use Botble\Member\Forms\PostForm as MemberPostForm;
use Botble\Page\Models\Page;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Widget\Events\RenderingWidgetSettings;
use Illuminate\Routing\Events\RouteMatched;

if (! function_exists('format_phone')) {
    function format_phone($phone)
    {
        if (empty($phone)) {
            return '';
        }

        $numbers = preg_replace('/\D/', '', $phone);
        $length = strlen($numbers);

        if ($length <= 4) {
            return $numbers;
        }

        $result = [];
        $index = 0;
        $toggle = true;

        while ($index < $length) {
            $groupSize = $toggle ? 4 : 3;
            $result[] = substr($numbers, $index, $groupSize);
            $index += $groupSize;
            $toggle = ! $toggle;
        }

        return implode('.', $result);
    }
}

app()->booted(function () {
    RvMedia::addSize('featured', 565, 375)
        ->addSize('medium', 540, 360);
});

DashboardMenu::default()->beforeRetrieving(function () {
    DashboardMenu::make()->registerItem([
        'id' => 'cms-core-home',
        'priority' => 2.5,
        'parent_id' => null,
        'name' => __('Home Page'),
        'url' => fn() => route('theme.home'),
        'permissions' => ['theme.options'],
        'icon' => 'fa fa-house',
    ]);

    DashboardMenu::make()->registerItem([
        'id' => 'cms-core-appearance-header',
        'priority' => 2.4,
        'parent_id' => 'cms-core-appearance',
        'name' => __('Header'),
        'url' => fn() => route('theme.header'),
        'permissions' => ['theme.options'],
    ]);

    DashboardMenu::make()->registerItem([
        'id' => 'cms-core-appearance-footer',
        'priority' => 2.5,
        'parent_id' => 'cms-core-appearance',
        'name' => __('Footer'),
        'url' => fn() => route('theme.footer'),
        'permissions' => ['theme.options'],
    ]);

    DashboardMenu::make()->registerItem([
        'id' => 'cms-core-appearance-blog-layout',
        'priority' => 2.6,
        'parent_id' => 'cms-core-appearance',
        'name' => __('Blog Layout'),
        'url' => fn() => route('theme.blog-layout'),
        'permissions' => ['theme.options'],
    ]);

    if (function_exists('is_plugin_active') && is_plugin_active('bigsoft-service')) {
        DashboardMenu::make()->registerItem([
            'id' => 'cms-core-appearance-service-layout',
            'priority' => 2.7,
            'parent_id' => 'cms-core-appearance',
            'name' => __('Service Layout'),
            'url' => fn() => route('theme.service-layout'),
            'permissions' => ['theme.options'],
        ]);
    }

    DashboardMenu::make()->registerItem([
        'id' => 'cms-core-appearance-404',
        'priority' => 3.5,
        'parent_id' => 'cms-core-appearance',
        'name' => __('404'),
        'url' => fn() => route('theme.404'),
        'permissions' => ['theme.options'],
    ]);
});

app('events')->listen(RouteMatched::class, function () {
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerSiteCopyright();

    register_page_template([
        'no-sidebar' => __('No sidebar'),
        'default-no-sidebar' => 'Default No Sidebar Page',
        'home-page' => 'Home Page',
    ]);

    app('events')->listen(RenderingWidgetSettings::class, function () {
        register_sidebar([
            'id' => 'top_sidebar',
            'name' => __('Top sidebar'),
            'description' => __('Area for widgets on the top sidebar'),
        ]);

        register_sidebar([
            'id' => 'service_sidebar',
            'name' => __('Service sidebar'),
            'description' => __('Area for widgets on service pages'),
        ]);

        register_sidebar([
            'id' => 'footer_sidebar',
            'name' => __('Footer sidebar'),
            'description' => __('Area for footer widgets'),
        ]);
    });

    // Fallback: inject providers & hot vouchers into home-page view if a controller didn't provide them
    view()->composer('theme.bigsoft::views.home-page', function ($view) {
        if (! class_exists(\Botble\Voucher\Models\Provider::class)) {
            return;
        }

        if (! $view->offsetExists('providers')) {
            $providers = \Botble\Voucher\Models\Provider::query()
                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                ->orderByDesc('created_at')
                ->get();

            $view->with('providers', $providers);
        }

        if (! $view->offsetExists('hotVouchers') && class_exists(\Botble\Voucher\Models\Voucher::class)) {
            $today = \Carbon\Carbon::now()->startOfDay();

            $hotVouchers = \Botble\Voucher\Models\Voucher::query()
                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                ->where('show_homepage_hot', true)
                ->where(function ($query) use ($today) {
                    $query
                        ->whereNull('expired_at')
                        ->orWhereDate('expired_at', '>=', $today);
                })
                ->with('provider')
                ->orderByRaw('CASE WHEN expired_at IS NULL THEN 1 ELSE 0 END')
                ->orderBy('expired_at')
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            $view->with('hotVouchers', $hotVouchers);
        }

        if (! $view->offsetExists('promoPosts') && class_exists(\Botble\Blog\Models\Post::class)) {
            $promoPosts = \Botble\Blog\Models\Post::query()
                ->wherePublished()
                ->with(['slugable', 'categories', 'author'])
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();

            $view->with('promoPosts', $promoPosts);
        }
    });

    FormAbstract::extend(function (FormAbstract $form): void {
        $model = $form->getModel();

        if (! $model instanceof Post && ! $model instanceof Page) {
            return;
        }

        $form
            ->addAfter(
                'image',
                'banner_image',
                MediaImageField::class,
                MediaImageFieldOption::make()->label(__('Banner image (1920x170px)'))->metadata()->toArray()
            );
    }, 124);

    FormAbstract::afterSaving(function (FormAbstract $form): void {
        if (! $form instanceof MemberPostForm) {
            return;
        }

        $request = $form->getRequest();

        $request->validate([
            'banner_image_input' => ['nullable', new MediaImageRule],
        ]);

        if ($request->hasFile('banner_image_input')) {
            $result = RvMedia::handleUpload($request->file('banner_image_input'), 0, 'members');

            if (! $result['error']) {
                MetaBox::saveMetaBoxData($form->getModel(), 'banner_image', $result['data']->url);
            }
        }
    }, 175);

    if (! function_exists('format_phone')) {
        function format_phone($phone)
        {
            if (empty($phone)) {
                return '';
            }

            $numbers = preg_replace('/\D/', '', $phone);
            $length = strlen($numbers);

            if ($length <= 4) {
                return $numbers;
            }

            $result = [];
            $index = 0;
            $toggle = true;

            while ($index < $length) {
                $groupSize = $toggle ? 4 : 3;
                $result[] = substr($numbers, $index, $groupSize);
                $index += $groupSize;
                $toggle = ! $toggle;
            }

            return implode('.', $result);
        }
    }
});

app('events')->listen(RouteMatched::class, function () {});
