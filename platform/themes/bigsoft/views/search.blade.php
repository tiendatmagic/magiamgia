@php
    $layout = theme_option('blog_layout', 'default');
    Theme::layout($layout === 'no-sidebar' ? 'default-no-sidebar' : $layout);

    $cols = max(1, min(6, (int) theme_option('blog_grid_cols', 2)));
    $colsSm = max(1, min(6, (int) theme_option('blog_grid_cols_sm', 2)));
    $colsMd = max(1, min(6, (int) theme_option('blog_grid_cols_md', 3)));
    $colsLg = max(1, min(6, (int) theme_option('blog_grid_cols_lg', 4)));
    $colsXl = max(1, min(6, (int) theme_option('blog_grid_cols_xl', 4)));

    $gridClass = sprintf(
        'tw-grid tw-grid-cols-%d sm:tw-grid-cols-%d md:tw-grid-cols-%d lg:tw-grid-cols-%d xl:tw-grid-cols-%d tw-gap-6',
        $cols,
        $colsSm,
        $colsMd,
        $colsLg,
        $colsXl
    );
@endphp
@php Theme::set('section-name', __('Search result for: ":query"', ['query' => BaseHelper::stringify(request()->input('q'))])) @endphp


<div class="">

    {!! Theme::partial('breadcrumb-posts') !!}

    <h2 class="tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold tw-mb-6"> {{ __('Search Post') }}  </h2>
    <div class="{{ $gridClass }}">
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <article class="post post__horizontal tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-border-gray-100 tw-border tw-flex tw-flex-col tw-transition-all clearfix">
                    <div class="post__thumbnail tw-relative" style="width: 100%">
                        {{ RvMedia::image($post->image, $post->name, 'medium') }}
                        <a
                            class="post__overlay"
                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                            title="{{ $post->name }}"
                        ></a>

                    </div>
                    <div class="post__content-wrap" style="width: 100%">
                        <header class="post__header">
                            <h3 class="post__title" style="width: 100%;">
                                <a
                                    href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}" class="tw-line-clamp-3"
                                    title="{{ $post->name }}"
                                >{{ $post->name }}</a></h3>

                        </header>
                        <div class="post__content tw-p-0 tw-mt-3">
                            <p class="tw-line-clamp-3">{{ $post->description }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        @endif
    </div>

    <div class="page-pagination tw-px-4 tw-py-6 tw-text-right">
        {!! $posts->withQueryString()->links() !!}
    </div>
</div>
