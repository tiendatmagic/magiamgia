@php
    $route = request()->route();
    $action = $route ? (string) $route->getActionName() : '';
    $isBigsoftServiceDetail = $action === \Botble\BigsoftService\Http\Controllers\BigsoftServiceController::class . '@detail';
@endphp

@if (is_plugin_active('blog') && ! $isBigsoftServiceDetail && $posts->isNotEmpty())
    @if ($sidebar == 'footer_sidebar')
        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
            <div class="widget widget--transparent widget__footer">
            @else
                <div class="widget widget__recent-post">
    @endif
    @if ($config['name'])
        <div class="widget__header">
            <h3 class="widget__title tw-text-[25px] tw-block tw-font-bold tw-uppercase tw-text-[#0c3980] tw-mb-6 tw-pl-[15px] tw-relative">{{ $config['name'] }}</h3>
        </div>
    @endif
    <div class="widget__content">
        <ul @if ($sidebar == 'footer_sidebar') class="list list--light list--fadeIn" @endif>
            @foreach ($posts as $post)
                <li>
                    @if ($sidebar == 'footer_sidebar')
                        <a
                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                            title="{{ $post->name }}"
                            data-number-line="2"
                        >{{ $post->name }}</a>
                    @else
                        <article class="post post__widget clearfix">
                            <div class="post__thumbnail">
                                {{ RvMedia::image($post->image, $post->name) }}
                                <a
                                    href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                    title="{{ $post->name }}"
                                    class="post__overlay"
                                ></a>
                            </div>
                            <header class="post__header">

                                <div class="tw-py-[10px] tw-flex tw-flex-col tw-h-full">
                                    <h4 class="post__title text-truncate-2">
                                        <a
                                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                            title="{{ $post->name }}"
                                            data-number-line="3" class="tw-text-[#0d6efd] hover:tw-text-[#0a58ca] tw-text-[17px] tw-font-bold tw-line-clamp-2 tw-text-center"
                                        >{{ $post->name }}</a>
                                    </h4>
                                </div>

                                <div class="post__meta">
                                </div>
                            </header>
                        </article>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    </div>
    @if ($sidebar == 'footer_sidebar')
        </div>
    @endif
@endif
