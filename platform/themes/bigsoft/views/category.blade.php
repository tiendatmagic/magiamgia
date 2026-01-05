@php
    $layout = theme_option('blog_layout', 'default');
    Theme::layout($layout === 'no-sidebar' ? 'default-no-sidebar' : $layout);
@endphp
@php Theme::set('section-name', $category->name) @endphp

<div>
<h2 class="tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold tw-mb-6"> {{ __('Post') }} </h2>
    @php
        $cols = max(1, min(6, (int) theme_option('blog_grid_cols', 2)));
        $colsSm = max(1, min(6, (int) theme_option('blog_grid_cols_sm', 2)));
        $colsMd = max(1, min(6, (int) theme_option('blog_grid_cols_md', 3)));
        $colsLg = max(1, min(6, (int) theme_option('blog_grid_cols_lg', 4)));
        $colsXl = max(1, min(6, (int) theme_option('blog_grid_cols_xl', 4)));

        $gridClass = sprintf(
            'tw-grid tw-grid-cols-%d sm:tw-grid-cols-%d md:tw-grid-cols-%d lg:tw-grid-cols-%d xl:tw-grid-cols-%d tw-gap-x-6 tw-gap-y-0',
            $cols,
            $colsSm,
            $colsMd,
            $colsLg,
            $colsXl
        );
    @endphp
    <div class="{{ $gridClass }}">
        @if ($posts->isNotEmpty())
            @foreach ($posts->loadMissing('author') as $post)
                <article
                    class="tw-flex tw-flex-col tw-overflow-hidden tw-w-full tw-h-auto tw-transition-all">

                    <div class="lg:tw-max-h-[168px] tw-h-auto tw-relative">
                        <a
                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                            title="{{ $post->name }}"
                            class="tw-block tw-w-full tw-h-full"
                        >
                            {{ RvMedia::image(
                                $post->image,
                                $post->name,
                                'high',
                                false,
                                ['class' => 'tw-w-full tw-h-full']
                            ) }}
                        </a>

                    </div>

                    <div class="tw-p-[15px] tw-flex tw-flex-col">
                        <h3 class="tw-h-12">
                            <a
                                href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                title="{{ $post->name }}"
                                class="tw-text-[#0d6efd] hover:tw-text-[#0a58ca] tw-text-[20px] tw-font-bold tw-line-clamp-2 tw-text-center"
                            >
                                {{ $post->name }}
                            </a>
                        </h3>
                    </div>
                </article>
            @endforeach

        @else
            <div class="alert alert-warning">
                <p class="mb-0">{{ __('There is no data to display!') }}</p>
            </div>
        @endif
    </div>
    <div class="page-pagination text-right">
        {!! $posts->links() !!}
    </div>
</div>