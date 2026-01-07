<section>

    <div class="">
        {!! Theme::partial('breadcrumb-posts') !!}
        <div class="tw-px-0 sm:tw-p-5 tw-pb-3 md:tw-pb-5 tw-w-full md:tw-bottom-12 sm:lg:tw-bottom-16 tw-z-10">
            <div class="tw-flex tw-max-w-5xl tw-mx-auto tw-mb-2">
                <form action="{{ route('public.search') }}" method="get" class="tw-w-full">
                    <div
                        class="tw-pr-2 tw-pl-5 tw-py-2 tw-shadow-lg input-search tw-border tw-border-gray-200 tw-bg-white tw-w-full tw-rounded-lg lg:tw-rounded-xl lg:tw-px-2 lg:tw-py-1 lg:tw-pl-4 tw-flex tw-overflow-hidden">
                        <input name="q" value="{{ request()->input('q') }}" placeholder="Tìm kiếm"
                            class="tw-w-full tw-h-14 tw-text-sm lg:tw-text-lg" style="outline: none;">
                        <button type="submit"
                            class="tw-p-3 lg:tw-m-0 tw-flex tw-flex-col tw-justify-center tw-border-0 tw-rounded-xl tw-overflow-hidden tw-cursor-pointer"
                            style="background-color: {{ theme_option('primary_color', '#AF0F26') }};">
                            <div
                                class="tw-flex tw-flex-col tw-justify-center tw-border-none tw-rounded-xl tw-overflow-hidden tw-cursor-pointer">
                                <svg class="tw-w-7 tw-h-7 tw-text-white tw-fill-white" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>


        @php
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

        <div class="{{ $gridClass }}">

            @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
            <article
                class="post post__horizontal tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-border-gray-100 tw-border tw-flex tw-flex-col tw-transition-all grid-interest-posts clearfix">
                <div class="post__thumbnail tw-relative" style="width: 100%">
                    {{ RvMedia::image($post->image, $post->name, 'medium') }}
                    <a class="post__overlay"
                        href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                        title="{{ $post->name }}"></a>

                </div>
                <div class="post__content-wrap" style="width: 100%">
                    <header class="post__header">
                        <h3 class="post__title" style="width: 100%;">
                            <a href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                class="tw-line-clamp-3" title="{{ $post->name }}">{{ $post->name }}</a>
                        </h3>

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
</section>
<style>
    .section.pt-50.pb-100 {
        background-color: #ecf0f1;
    }
</style>