<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


        @php(Theme::set('headerMeta', Theme::partial('header-meta')))

        {!! Theme::header() !!}

        <script src="/themes/bigsoft/js/tailwind.js"></script>
        <script>
            tailwind.config = {
                prefix: 'tw-',
            }
        </script>

    </head>
    <body {!! Theme::bodyAttributes() !!}>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}
    @php($headerLayout = theme_option('header_layout', 'logo-left'))
    @php($headerBackgroundColor = theme_option('header_background_color'))
    @php($headerSearchStyle = theme_option('header_search_style', 'icon'))
    <header
        data-sticky="false"
        data-sticky-checkpoint="200"
        data-responsive="991"
        class="page-header page-header--light"
        @if ($headerBackgroundColor) style="background-color: {{ $headerBackgroundColor }};" @endif
    >
        <div class="container">
            @if ($headerSearchStyle === 'topbar' && is_plugin_active('blog'))
                <div class="tw-flex tw-justify-end tw-items-center tw-py-2">
                    <form action="{{ route('public.search') }}" method="get" class="header-topbar-search tw-flex tw-gap-2">
                        <input
                            type="text"
                            name="q"
                            value="{{ request()->input('q') }}"
                            placeholder="{{ __('Type to search...') }}"
                            class="form-control"
                            style="max-width: 320px"
                        />
                        <button type="submit" class="btn btn--red" style="margin-bottom: 0">
                            {!! BaseHelper::renderIcon('ti ti-search') !!}
                        </button>
                    </form>
                </div>
            @endif

            @if ($headerLayout === 'logo-center')
                <div class="tw-flex tw-flex-col tw-items-center tw-gap-3">
                    <div class="tw-flex tw-justify-center tw-w-full">
                        <a href="{{ BaseHelper::getHomepageUrl() }}" class="page-logo">
                            @if ($logo = theme_option('logo'))
                                {{ RvMedia::image($logo, theme_option('site_title'), attributes: ['height' => 50]) }}
                            @endif
                        </a>
                    </div>

                    <div class="tw-w-full header-logo-center-bar">
                        <nav class="navigation navigation--light navigation--fade navigation--fadeLeft">
                            {!!
                                Menu::renderMenuLocation('main-menu', [
                                    'options' => ['class' => 'menu sub-menu--slideLeft'],
                                    'view'    => 'main-menu',
                                ])
                            !!}
                        </nav>

                        <div class="header-logo-center-actions">
                            @if ($headerSearchStyle === 'icon' && is_plugin_active('blog'))
                                @if (request()->is('tin-khuyen-mai*') || request()->is('category/*') || request()->is('tag/*') || request()->is('*.html') || request()->is('search*'))
                                    <div class="search-btn c-search-toggler">
                                        {!! BaseHelper::renderIcon('ti ti-search', attributes: ['class' => 'close-search']) !!}
                                    </div>
                                @endif
                            @endif

                            <div class="language_switcher language_switcher-desktop">
                                {!! apply_filters('language_switcher') !!}
                            </div>
                            <div class="language_switcher language_switcher-mobile">
                                {!! apply_filters('language_switcher') !!}
                            </div>

                            <div class="navigation-toggle navigation-toggle--dark"><span></span></div>
                        </div>
                    </div>
                </div>
            @else
                <div class="page-header__left">
                    <a href="{{ BaseHelper::getHomepageUrl() }}" class="page-logo">
                        @if ($logo = theme_option('logo'))
                            {{ RvMedia::image($logo, theme_option('site_title'), attributes: ['height' => 50]) }}
                        @endif
                    </a>
                </div>
                <div class="page-header__right">
                    <div class="tw-flex tw-items-center tw-justify-end tw-gap-2 header-right-actions">
                        <nav class="navigation navigation--light navigation--fade navigation--fadeLeft">
                            <div class="tw-flex tw-items-center tw-gap-3 tw-main-menu">
                                {!!
                                    Menu::renderMenuLocation('main-menu', [
                                        'options' => ['class' => 'menu sub-menu--slideLeft'],
                                        'view'    => 'main-menu',
                                    ])
                                !!}

                                <div class="language_switcher language_switcher-desktop">
                                    {!! apply_filters('language_switcher') !!}
                                </div>
                            </div>
                        </nav>

                        <div class="language_switcher language_switcher-mobile">
                            {!! apply_filters('language_switcher') !!}
                        </div>

                        <div class="navigation-toggle navigation-toggle--dark"><span></span></div>

                        @if ($headerSearchStyle === 'icon' && is_plugin_active('blog'))
                            @if (request()->is('tin-khuyen-mai*') || request()->is('category/*') || request()->is('tag/*') || request()->is('*.html') || request()->is('search*'))
                                <div class="search-btn c-search-toggler">
                                    {!! BaseHelper::renderIcon('ti ti-search', attributes: ['class' => 'close-search']) !!}
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="clearfix"></div>
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
        @if ($headerSearchStyle === 'icon' && is_plugin_active('blog'))
            <div class="super-search hide" data-search-url="{{ route('public.ajax.search') }}">
                <form class="quick-search" action="{{ route('public.search') }}">
                    <input type="text" name="q" placeholder="{{ __('Type to search...') }}" class="form-control search-input" autocomplete="off">
                    <span class="close-search">&times;</span>
                </form>
                <div class="search-result"></div>
            </div>
        @endif
    </header>
    <div id="page-wrap">
