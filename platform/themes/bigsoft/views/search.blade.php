@php
$layout = theme_option('blog_layout', 'default');
Theme::layout('no-sidebar');

$cols = max(1, min(6, (int) theme_option('blog_grid_cols', 2)));
$colsSm = max(1, min(6, (int) theme_option('blog_grid_cols_sm', 2)));
$colsMd = max(1, min(6, (int) theme_option('blog_grid_cols_md', 3)));
$colsLg = max(1, min(6, (int) theme_option('blog_grid_cols_lg', 4)));
$colsXl = max(1, min(6, (int) theme_option('blog_grid_cols_xl', 4)));

$gridClass = sprintf(
'tw-grid tw-grid-cols-%d sm:tw-grid-cols-%d md:tw-grid-cols-%d lg:tw-grid-cols-%d xl:tw-grid-cols-%d tw-gap-6
grid-interest-posts',
$cols,
$colsSm,
$colsMd,
$colsLg,
$colsXl
);
@endphp
@php Theme::set('section-name', __('Search result for: ":query"', ['query' =>
BaseHelper::stringify(request()->input('q'))])) @endphp

<style>
    .search-hero {
        position: relative;
    }

    .search-hero .hero-section {
        position: relative;
        overflow: hidden;
        background-color: transparent;
        background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 89%);
        transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    }

    .search-hero .hero-background-overlay {
        background-image: url('/storage/theme/image/News-Hero-Bg.png');

        background-position: center left;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.15;
        transition: background 0.3s,
            border-radius 0.3s,
            opacity 0.3s;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        position: absolute;
    }

    .search-hero .hero-shape {
        overflow: hidden;
        position: absolute;
        left: 0;
        width: 100%;
        line-height: 0;
        direction: ltr;
    }

    .search-hero .hero-shape[data-negative="false"].hero-shape-bottom,
    .search-hero .hero-shape[data-negative="true"].hero-shape-top {
        transform: rotate(180deg);
    }

    .search-hero .hero-shape-bottom {
        bottom: -1px;
    }

    .search-hero .hero-shape-bottom svg {
        width: calc(260% + 1.3px);
        height: 159px;
        transform: translateX(-50%) rotateY(180deg);
    }

    .search-hero .hero-shape-bottom:not([data-negative="true"]) svg {
        z-index: -1;
    }

    .search-hero .hero-shape svg {
        display: block;
        position: relative;
        left: 50%;
    }

    .search-hero .hero-shape-fill {
        fill: #fff;
        transform-origin: center;
        transform: rotateY(0deg);
    }

    .search-hero .hero-container {
        max-width: 1200px;
        min-height: 340px;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        position: relative;
    }

    .search-hero .hero-row {
        width: 100%;
        display: flex;
    }

    .search-hero .hero-column {
        width: 100%;
        display: flex;
    }

    .search-hero .hero-column-wrap {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-content: flex-start;
        padding: 10px;
    }

    .search-hero .hero-widget-wrap {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-content: flex-start;
        align-items: flex-start;
        top: 30%;
        position: relative;
        transform: translateY(-50%);
    }

    .search-hero .hero-widget-wrap>*:not(:last-child) {
        margin-bottom: 20px;
    }

    .search-hero .hero-title,
    .search-hero .hero-subtitle {
        width: 100%;
        text-align: center;
    }

    .search-hero .hero-heading-container {
        transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    }

    .search-hero .hero-heading-title {
        color: #ffffff;
        font-family: "Montserrat", sans-serif;
        font-size: 33px;
        font-weight: 300;
        text-transform: capitalize;
        padding: 0;
        margin: 0;
        line-height: 1;
    }

    @media (min-width: 768px) {
        .search-hero .hero-column {
            width: 100%;
        }
    }
</style>

<div class="search-hero">

    <section class="hero-section">
        <div class="hero-background-overlay"></div>
        <div class="hero-shape hero-shape-bottom" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                <path class="hero-shape-fill"
                    d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"
                    </path>
                    <path class="hero-shape-fill"
                        d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3C267.7,18.8,269.7,18,269.6,18z"
                        </path>
                        <path class="hero-shape-fill"
                            d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2S227.6,9.9,227.4,9.8z"
                            </path>
                            <path class="hero-shape-fill"
                                d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4C206.4,12.9,204.6,13.5,204.5,13.4z"
                                </path>
                                <path class="hero-shape-fill"
                                    d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6S201,10.7,201,10.6z"
                                    </path>
                                    <path class="hero-shape-fill"
                                        d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3C152.6,27.5,154.6,26.8,154.5,26.7z"
                                        </path>
                                        <path class="hero-shape-fill"
                                            d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"
                                            </path>
                                            <path class="hero-shape-fill"
                                                d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0C76.9,11.5,75.3,12.5,75.5,12.6z"
                                                </path>
                                                <path class="hero-shape-fill"
                                                    d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4C19.9,13.7,15.7,13.3,15.6,13.2z"
                                                    </path>
            </svg>
        </div>
        <div class="hero-container">
            <div class="hero-row">
                <div class="hero-column">
                    <div class="hero-column-wrap">
                        <div class="hero-widget-wrap">
                            <div class="hero-title">
                                <div class="hero-heading-container">
                                    <h1 class="hero-heading-title tw-text-3xl tw-text-white">
                                        {{ __('Search Result For: ":query"', ['query' => BaseHelper::stringify(request()->input('q'))]) }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container {{ $posts->isNotEmpty() ? 'tw-mt-[-130px]' : '' }}">
        <div class="{{ $gridClass }}">
            @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
            <article
                class="post post__horizontal tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-border-gray-100 tw-border tw-flex tw-flex-col tw-transition-all clearfix">
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
            @else
            <div class="tw-col-span-full tw-text-center">
                <p class="tw-text-black tw-font-bold tw-text-xl">{{ __("It seems we can't find what you're looking for") }}
                </p>

                <div>
                    <img src="{{ asset('storage/theme/image/icon-no-search.png') }}" class="tw-mx-auto tw-max-w-96" alt="">
                </div>
            </div>
            @endif
        </div>

        <div class="page-pagination tw-px-4 tw-py-6 tw-text-right">
            {!! $posts->withQueryString()->links() !!}
        </div>
    </div>
</div>