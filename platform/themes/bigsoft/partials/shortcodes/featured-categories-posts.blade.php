<section class="section pt-50 pb-50 bg-lightgray">
    <div class="container">
        <div class="row">
            @php
                $primarySidebarContent = $withSidebar ? dynamic_sidebar('primary_sidebar') : null;
            @endphp
            <div @class([
                'col-lg-9' => $primarySidebarContent,
                'col-12' => !$primarySidebarContent,
            ])>
                <div class="page-content">
                    <div class="post-group post-group--single">
                        <div class="post-group__header">
                            <h3 class="post-group__title">{{ $title }}</h3>
                        </div>
                        <div class="post-group__content">
                            <div class="row">
                                @foreach ($posts->chunk(3) as $chunk)
                                    <div class="col-md-6 col-sm-6 col-12">
                                        @foreach ($chunk as $post)
                                            @if ($loop->first)
                                                <article
                                                    class="post post__vertical post__vertical--single post__vertical--simple"
                                                >
                                                    <div class="post__thumbnail">
                                                        {{ RvMedia::image($post->image, $post->name, 'medium') }}
                                                        <a
                                                            class="post__overlay"
                                                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                                            title="{{ $post->name }}"
                                                        ></a>
                                                    </div>
                                                    <div class="post__content-wrap">
                                                        <header class="post__header">
                                                            <h3 class="post__title"><a
                                                                    href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                                                    title="{{ $post->name }}"
                                                                >{{ $post->name }}</a></h3>
                                                            <div class="post__meta">

                                                            </div>
                                                        </header>
                                                        <div class="post__content">
                                                            <p data-number-line="2">{{ $post->description }}</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            @else
                                                <article
                                                    class="post post__horizontal post__horizontal--single clearfix mb-20"
                                                >
                                                    <div class="post__thumbnail">
                                                        {{ RvMedia::image($post->image, $post->name, 'medium') }}
                                                        <a
                                                            class="post__overlay"
                                                            href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                                            title="{{ $post->name }}"
                                                        ></a>
                                                    </div>
                                                    <div class="post__content-wrap">
                                                        <header class="post__header">
                                                            <h3 class="post__title"><a
                                                                    href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"
                                                                    title="{{ $post->name }}"
                                                                >{{ $post->name }}</a></h3>
                                                            <div class="post__meta">

                                                            </div>
                                                        </header>
                                                    </div>
                                                </article>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($primarySidebarContent)
                <div class="col-lg-3">
                    <div class="page-sidebar">
                        {!! $primarySidebarContent !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
