@php

$layout = theme_option('post_layout', 'default');
Theme::layout($layout === 'no-sidebar' ? 'default-no-sidebar' : $layout);

use Illuminate\Support\Facades\Request;
$currentUri = Request::path();

// Only check .html suffix if post exists and current URL doesn't match
if ($post->id && !str_ends_with($currentUri, '.html')) {
    $expectedUrl = $post->url . (str_ends_with($post->url, '.html') ? '' : '.html');
    if ($currentUri !== trim($expectedUrl, '/')) {
        abort(404);
    }
}

Theme::set('section-name', $post->name);
$post->loadMissing(['metadata', 'categories']);

if ($bannerImage = $post->getMetaData('banner_image', true)) {
Theme::set('breadcrumbBannerImage', RvMedia::getImageUrl($bannerImage));
}
@endphp

{!! Theme::partial('breadcrumb-posts', ['post' => $post]) !!}

<article class="post post--single">
    <header class="post__header">
        <h1 class="post__title">{{ $post->name }}</h1>
        <div class="post__meta">
            {{-- {!! Theme::partial('blog.post-meta', compact('post')) !!}

            @if ($post->tags->isNotEmpty())
            @php
            if (is_plugin_active('language-advanced')) {
            $post->tags->loadMissing('translations');
            }
            @endphp
            <span class="post__tags">
                {!! BaseHelper::renderIcon('ti ti-tags') !!}
                @foreach ($post->tags as $tag)
                <a href="{{ $tag->url }}" class="me-0">{{ $tag->name }}</a>@if (!$loop->last), @endif
                @endforeach
            </span>
            @endif --}}
        </div>
    </header>
    <div class="post__content">
        @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($post)))
        {!! render_object_gallery($galleries, ($post->first_category ? $post->first_category->name : __('Uncategorized'))) !!}
        @endif
        <div class="ck-content">{!! BaseHelper::clean($post->content) !!}</div>
        <div class="fb-like" data-href="{{ request()->url() }}" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
    </div>
    @php
        $maxInterest = 8;
        $categoryIds = $post->categories->pluck('id')->all();

        $interestPosts = collect();

        if (! empty($categoryIds)) {
            $interestPosts = \Botble\Blog\Models\Post::query()
                ->where('id', '!=', $post->id)
                ->wherePublished()
                ->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                })
                ->with(['slugable', 'categories', 'author'])
                ->orderByDesc('created_at')
                ->limit($maxInterest)
                ->get();
        }

        if ($interestPosts->count() < $maxInterest) {
            $remaining = $maxInterest - $interestPosts->count();
            $excludeIds = $interestPosts->pluck('id')->push($post->id)->all();

            $latest = \Botble\Blog\Models\Post::query()
                ->wherePublished()
                ->whereNotIn('id', $excludeIds)
                ->with(['slugable', 'categories', 'author'])
                ->orderByDesc('created_at')
                ->limit($remaining)
                ->get();

            $interestPosts = $interestPosts->concat($latest);
        }

        $cols = max(1, min(6, (int) theme_option('blog_grid_cols', 2)));
        $colsSm = max(1, min(6, (int) theme_option('blog_grid_cols_sm', 2)));
        $colsMd = max(1, min(6, (int) theme_option('blog_grid_cols_md', 3)));
        $colsLg = max(1, min(6, (int) theme_option('blog_grid_cols_lg', 4)));
        $colsXl = max(1, min(6, (int) theme_option('blog_grid_cols_xl', 4)));

        $gridClass = sprintf(
            'tw-grid tw-grid-cols-%d sm:tw-grid-cols-%d md:tw-grid-cols-%d lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-6 grid-interest-posts',
            $cols,
            $colsSm,
            $colsMd,
            $colsLg,
            $colsXl
        );
    @endphp

    @if ($interestPosts->isNotEmpty())
        <section class="tw-mt-8 tw-mb-4">
            <h4 class="tw-text-xl tw-font-semibold tw-mb-4">{{ __('You may also like') }}</h4>
            <div class="{{ $gridClass }}">
                @foreach ($interestPosts as $relatedItem)
                    <article class="post post__horizontal tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-border-gray-100 tw-border tw-flex tw-flex-col tw-transition-all clearfix">
                        <div class="post__thumbnail tw-relative" style="width: 100%">
                            {{ RvMedia::image($relatedItem->image, $relatedItem->name, 'medium') }}
                            <a
                                class="post__overlay"
                                href="{{ preg_match('/\.html$/i', $relatedItem->url) ? preg_replace('/(\.html)+$/i', '.html', $relatedItem->url) : $relatedItem->url . '.html' }}"
                                title="{{ $relatedItem->name }}"
                            ></a>

                        </div>
                        <div class="post__content-wrap" style="width: 100%">
                            <header class="post__header">
                                <h3 class="post__title" style="width: 100%;">
                                    <a
                                        href="{{ preg_match('/\.html$/i', $relatedItem->url) ? preg_replace('/(\.html)+$/i', '.html', $relatedItem->url) : $relatedItem->url . '.html' }}" class="tw-line-clamp-3"
                                        title="{{ $relatedItem->name }}"
                                    >{{ $relatedItem->name }}</a></h3>

                            </header>
                            <div class="post__content tw-p-0 tw-mt-3">
                                <p class="tw-line-clamp-3">{{ $relatedItem->description }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
    <br>
    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
</article>