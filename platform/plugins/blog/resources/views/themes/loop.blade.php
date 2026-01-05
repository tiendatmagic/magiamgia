@foreach ($posts as $post)
    <div>
        <article>
            <div><a href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"></a>
                <img
                    src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}"
                    alt="{{ $post->name }}"
                >
            </div>
            <header><a href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}"> {{ $post->name }}</a></header>
        </article>
    </div>
@endforeach

<div class="pagination">
    {!! $posts->withQueryString()->links() !!}
</div>
