<?php

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Models\BaseQueryBuilder;
use Botble\Blog\Models\Category;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Arr;

app('events')->listen(RouteMatched::class, function () {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    if (is_plugin_active('blog')) {
        Shortcode::setPreviewImage('blog-posts', Theme::asset()->url('images/ui-blocks/blog-posts.png'));

        Shortcode::register(
            'featured-posts',
            __('Featured posts'),
            __('Featured posts'),
            function (ShortcodeCompiler $shortcode) {
                $posts = get_featured_posts((int) $shortcode->limit ?: 5, [
                    'author',
                ]);

                return Theme::partial('shortcodes.featured-posts', compact('posts'));
            }
        );

        Shortcode::setAdminConfig('featured-posts', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('limit', NumberField::class, TextFieldOption::make()->label(__('Limit'))->toArray());
        });

        Shortcode::setPreviewImage('featured-posts', Theme::asset()->url('images/ui-blocks/featured-posts.png'));

        Shortcode::register(
            'recent-posts',
            __('Recent posts'),
            __('Recent posts'),
            function (ShortcodeCompiler $shortcode) {
                $posts = get_latest_posts(7, [], ['slugable']);

                $withSidebar = ($shortcode->with_sidebar ?: 'yes') === 'yes';

                return Theme::partial('shortcodes.recent-posts', [
                    'title' => $shortcode->title,
                    'withSidebar' => $withSidebar,
                    'posts' => $posts,
                ]);
            }
        );

        Shortcode::setPreviewImage('recent-posts', Theme::asset()->url('images/ui-blocks/recent-posts.png'));

        Shortcode::setAdminConfig('recent-posts', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add(
                    'with_sidebar',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('With top sidebar?'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->defaultValue('yes')
                        ->toArray()
                );
        });

        Shortcode::register(
            'featured-categories-posts',
            __('Featured categories posts'),
            __('Featured categories posts'),
            function (ShortcodeCompiler $shortcode) {
                $with = [
                    'slugable',
                    'posts' => function (BelongsToMany|BaseQueryBuilder $query) {
                        $query
                            ->wherePublished()
                            ->orderByDesc('created_at');
                    },
                    'posts.slugable',
                ];

                if (is_plugin_active('language-advanced')) {
                    $with[] = 'posts.translations';
                }

                $posts = collect();

                if ($categoryId = $shortcode->category_id) {
                    $with['posts'] = function (BelongsToMany|BaseQueryBuilder $query) {
                        $query
                            ->wherePublished()
                            ->orderByDesc('created_at')
                            ->take(6);
                    };

                    $category = Category::query()
                        ->with($with)
                        ->wherePublished()
                        ->where('id', $categoryId)
                        ->select([
                            'id',
                            'name',
                            'description',
                            'icon',
                        ])
                        ->first();

                    if ($category) {
                        $posts = $category->posts;
                    } else {
                        $posts = collect();
                    }
                } else {
                    $categories = get_featured_categories(2, $with);

                    foreach ($categories as $category) {
                        $posts = $posts->merge($category->posts->take(3));
                    }

                    $posts = $posts->sortByDesc('created_at');
                }

                $withSidebar = ($shortcode->with_sidebar ?: 'yes') === 'yes';

                return Theme::partial(
                    'shortcodes.featured-categories-posts',
                    [
                        'title' => $shortcode->title,
                        'withSidebar' => $withSidebar,
                        'posts' => $posts,
                    ]
                );
            }
        );

        Shortcode::setPreviewImage(
            'featured-categories-posts',
            Theme::asset()->url('images/ui-blocks/featured-categories-posts.png')
        );

        Shortcode::setAdminConfig('featured-categories-posts', function (array $attributes) {
            $categories = Category::query()
                ->wherePublished()
                ->select('name', 'id')
                ->get()
                ->mapWithKeys(fn ($item) => [$item->id => $item->name])
                ->all();

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Title'))->toArray())
                ->add(
                    'category_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Category'))
                        ->choices(['' => __('All')] + $categories)
                        ->selected(Arr::get($attributes, 'category_id'))
                        ->searchable()
                        ->toArray()
                )
                ->add(
                    'with_sidebar',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('With primary sidebar?'))
                        ->choices(['yes' => __('Yes'), 'no' => __('No')])
                        ->defaultValue('yes')
                        ->toArray()
                );
        });
    }

    if (is_plugin_active('contact')) {
        Shortcode::setPreviewImage('contact-form', Theme::asset()->url('images/ui-blocks/contact-form.png'));
        Shortcode::register(
            'contact-form',
            __('Contact Form'),
            __('Contact form'),
            function ($shortcode) {
                return Theme::partial('shortcodes.contact-form');
            }
        );

        Shortcode::register(
            'detailFormContact',
            __('Detail Form Contact'),
            __('Alias for contact form'),
            function ($shortcode) {
                return Theme::partial('shortcodes.contact-form');
            }
        );
    }

    if (is_plugin_active('gallery')) {
        Shortcode::setPreviewImage('gallery', Theme::asset()->url('images/ui-blocks/gallery.png'));

        Shortcode::register(
            'all-galleries',
            __('All galleries'),
            __('All galleries'),
            function (ShortcodeCompiler $shortcode) {
                return Theme::partial('shortcodes.all-galleries', ['limit' => (int) $shortcode->limit]);
            }
        );

        Shortcode::setPreviewImage('all-galleries', Theme::asset()->url('images/ui-blocks/all-galleries.png'));

        Shortcode::setAdminConfig('all-galleries', function (array $attributes) {
            return ShortcodeForm::createFromArray($attributes)
                ->add('limit', NumberField::class, TextFieldOption::make()->label(__('Limit'))->toArray());
        });
    }
});

Shortcode::register(
    'section-button-to-form',
    __('Button to form'),
    __('Button leading to contact/form section'),
    function ($shortcode) {
        return Theme::partial('shortcodes.section-button-to-form', [
            'shortcode' => $shortcode,
        ]);
    }
)
    ->setPreviewImage('section-button-to-form', asset('storage/theme/image/form-preview.jpg'))
    ->setAdminConfig('section-button-to-form', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'button_text',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button text'))
                    ->placeholder('Button text')
                    ->maxLength(255)
                    ->required()
                    ->toArray()
            )
            ->add(
                'link',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Link (href)'))
                    ->placeholder('#detailFormContact')
                    ->maxLength(255)
                    ->required()
                    ->toArray()
            );
    });

// Partner section

Shortcode::register(
    'partner-home',
    __('Partner Home'),
    __('Section đối tác với danh sách đối tác'),
    function () {
        return Theme::partial('shortcodes.partner-home');
    }
)
    ->setPreviewImage('partner-home', asset('storage/theme/image/partner-preview.jpg'));

// Service List shortcode
if (is_plugin_active('bigsoft-service')) {
    Shortcode::register(
        'bigsoft-service-list',
        __('Service List'),
        __('Danh sách dịch vụ vận tải (tối đa 8 bài viết mới nhất)'),
        function (ShortcodeCompiler $shortcode) {

            $with = ['categories'];

            if (is_plugin_active('language-advanced')) {
                $with[] = 'translations';
                $with[] = 'categories.translations';
            }

            $query = \Botble\BigsoftService\Models\BigsoftService::query()
                ->with($with)
                ->where('status', 'published');

            if ($categoryId = $shortcode->category_id) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->whereKey($categoryId);
                });
            }

            $services = $query
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();

            return Theme::partial('shortcodes.bigsoft-service-list', [
                'services' => $services,
                'title' => $shortcode->title,
            ]);
        }
    )
        ->setPreviewImage('bigsoft-service-list', asset('storage/theme/image/bigsoft-service-preview.jpg'))
        ->setAdminConfig('bigsoft-service-list', function (array $attributes) {
            $categories = \Botble\BigsoftService\Models\BigsoftServiceCategory::query()
                ->where('status', 'published')
                ->select('name', 'id')
                ->orderBy('name')
                ->get()
                ->mapWithKeys(fn ($item) => [$item->id => $item->name])
                ->all();

            return ShortcodeForm::createFromArray($attributes)
                ->add('title', TextField::class, TextFieldOption::make()->label(__('Tiêu đề'))->toArray())
                ->add(
                    'category_id',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(__('Danh mục'))
                        ->choices(['' => __('Tất cả')] + $categories)
                        ->selected(Arr::get($attributes, 'category_id'))
                        ->searchable()
                        ->toArray()
                );
        });
}
