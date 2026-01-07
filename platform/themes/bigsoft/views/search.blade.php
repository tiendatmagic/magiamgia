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
    .elementor-37995 .elementor-element.elementor-element-429a0fd9:not(.elementor-motion-effects-element-type-background),
    .elementor-37995 .elementor-element.elementor-element-429a0fd9>.elementor-motion-effects-container>.elementor-motion-effects-layer {
        background-color: transparent;
        background-image: linear-gradient(130deg, #0700dd 0%, #00f2ff 89%);
    }

    .elementor-37995 .elementor-element.elementor-element-429a0fd9 {
        overflow: hidden;
        transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    }

    .elementor-section {
        position: relative;
    }

    .elementor-37995 .elementor-element.elementor-element-429a0fd9>.elementor-background-overlay {
        background-image: url(https://magiamgia.com/wp-content/uploads/2021/01/News-Hero-Bg.png);
        background-position: center left;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.15;
        transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        position: absolute;
    }

    .elementor .elementor-background-overlay,
    .elementor .elementor-background-slideshow {
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        position: absolute;
    }

    .elementor-shape[data-negative=false].elementor-shape-bottom,
    .elementor-shape[data-negative=true].elementor-shape-top {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .elementor-shape-bottom {
        bottom: -1px;
    }

    .elementor-shape {
        overflow: hidden;
        position: absolute;
        left: 0;
        width: 100%;
        line-height: 0;
        direction: ltr;
    }

    .elementor-37995 .elementor-element.elementor-element-429a0fd9>.elementor-shape-bottom svg {
        width: calc(260% + 1.3px);
        height: 159px;
        transform: translateX(-50%) rotateY(180deg);
    }


    .elementor-shape-bottom:not([data-negative=true]) svg {
        z-index: -1;
    }

    .elementor-shape svg {
        display: block;
        width: calc(100% + 1.3px);
        position: relative;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
    }

    .elementor-37995 .elementor-element.elementor-element-429a0fd9>.elementor-shape-bottom .elementor-shape-fill {
        fill: #fff;
    }

    .elementor-shape .elementor-shape-fill {
        fill: #fff;
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
        -webkit-transform: rotateY(0deg);
        transform: rotateY(0deg);
    }

    .elementor-37995 .elementor-element.elementor-element-429a0fd9>.elementor-container {
        max-width: 1200px;
        min-height: 340px;
    }

    .elementor-section.elementor-section-items-top>.elementor-container {
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .elementor-section .elementor-container {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-right: auto;
        margin-left: auto;
        position: relative;
    }

    .elementor-row {
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    @media (min-width: 768px) {

        .elementor-column.elementor-col-100,
        .elementor-column[data-col="100"] {
            width: 100%;
        }
    }

    .elementor-column,
    .elementor-column-wrap {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .elementor-column {
        min-height: 1px;
    }

    .elementor-column-wrap {
        width: 100%;
    }

    .elementor-column,
    .elementor-column-wrap {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .elementor-37995 .elementor-element.elementor-element-6d099801.elementor-column.elementor-element[data-element_type="column"]>.elementor-column-wrap.elementor-element-populated>.elementor-widget-wrap {
        align-content: flex-start;
        align-items: flex-start;
    }

    .elementor-column-gap-default>.elementor-row>.elementor-column>.elementor-element-populated>.elementor-widget-wrap {
        padding: 10px;
    }

    .elementor:not(.elementor-bc-flex-widget) .elementor-widget-wrap {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .elementor-widget-wrap {
        position: relative;
        width: 100%;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-line-pack: start;
        align-content: flex-start;
    }

    .elementor-37995 .elementor-element.elementor-element-71d69216 {
        text-align: center;
    }

    .elementor-widget:not(:last-child) {
        margin-bottom: 20px;
    }

    .elementor-widget-wrap>.elementor-element {
        width: 100%;
    }

    .elementor-widget {
        position: relative;
    }

    .elementor-37995 .elementor-element.elementor-element-20be0843 {
        text-align: center;
    }

    .elementor-widget-wrap>.elementor-element {
        width: 100%;
    }

    .elementor-widget {
        position: relative;
    }

    .elementor-element .elementor-widget-container {
        -webkit-transition: background .3s, border .3s, -webkit-border-radius .3s, -webkit-box-shadow .3s;
        transition: background .3s, border .3s, -webkit-border-radius .3s, -webkit-box-shadow .3s;
        -o-transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;
        transition: background .3s, border .3s, border-radius .3s, box-shadow .3s;
        transition: background .3s, border .3s, border-radius .3s, box-shadow .3s, -webkit-border-radius .3s, -webkit-box-shadow .3s;
    }

    .elementor-37995 .elementor-element.elementor-element-20be0843 .elementor-heading-title {
        color: #ffffff;
        font-family: "Montserrat", Sans-serif;
        font-size: 33px;
        font-weight: 300;
        text-transform: capitalize;
    }

    .elementor-heading-title {
        padding: 0;
        margin: 0;
        line-height: 1;
    }
</style>

<div class="elementor-37995">

    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-429a0fd9 elementor-section-height-min-height elementor-section-items-top elementor-section-content-middle elementor-section-boxed elementor-section-height-default"
        data-id="429a0fd9" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;shape_divider_bottom&quot;:&quot;wave-brush&quot;}">
        <div class="elementor-background-overlay"></div>
        <div class="elementor-shape elementor-shape-bottom" data-negative="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
                <path class="elementor-shape-fill"
                    d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z">
                </path>
                <path class="elementor-shape-fill"
                    d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z">
                </path>
                <path class="elementor-shape-fill"
                    d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z">
                </path>
                <path class="elementor-shape-fill"
                    d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z">
                </path>
                <path class="elementor-shape-fill"
                    d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z">
                </path>
                <path class="elementor-shape-fill"
                    d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z">
                </path>
                <path class="elementor-shape-fill"
                    d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z">
                </path>
                <path class="elementor-shape-fill"
                    d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z">
                </path>
                <path class="elementor-shape-fill"
                    d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z">
                </path>
            </svg>
        </div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-row">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6d099801"
                    data-id="6d099801" data-element_type="column">
                    <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                            <div
                                class="elementor-element elementor-element-71d69216 elementor-widget elementor-widget-theme-archive-title elementor-page-title elementor-widget-heading"
                                data-id="71d69216" data-element_type="widget" data-widget_type="theme-archive-title.default">
                                <div class="elementor-widget-container">
                                    <h1 class="elementor-heading-title elementor-size-default">Hướng Dẫn</h1>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-20be0843 elementor-widget elementor-widget-heading"
                                data-id="20be0843" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <h2 class="elementor-heading-title elementor-size-default">Hướng dẫn kinh nghiệm mua sắm online</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {!! Theme::partial('breadcrumb-posts') !!}

    <div class="container">
        <h2 class=" tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold tw-mb-6"> {{ __('Search Post') }} </h2>
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
            </div>
            @endif
        </div>

        <div class="page-pagination tw-px-4 tw-py-6 tw-text-right">
            {!! $posts->withQueryString()->links() !!}
        </div>
    </div>
</div>