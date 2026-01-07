@php
    $blogPageId = get_blog_page_id();
    $blogPage = $blogPageId ? \Botble\Page\Models\Page::find($blogPageId) : null;

    $postCategory = null;
    if (isset($post) && $post) {
        if (method_exists($post, 'loadMissing')) {
            $post->loadMissing(['categories']);
        }

        $postCategory = $post->first_category ?: ($post->categories->first() ?? null);
    }
@endphp

<div class="breadcrumb-all content-section tw-my-1 container"
    style="--primary-color: {{ theme_option('primary_color', '#AF0F26') }}; --breadcrumb-base: {{ theme_option('primary_color', '#AF0F26') }};">
    <div class="breadcrumb-item tw-flex tw-gap-2 tw-text-sm tw-text-gray-600 tw-mb-6">
        <a href="{{ BaseHelper::getHomepageUrl() }}" class="">Trang chủ</a>
        @if ($blogPage)
            <a href="{{ $blogPage->url }}" class="">{{ $blogPage->name }}</a>
        @endif
        @if ($postCategory)
            <a href="{{ $postCategory->url }}" class="">{{ $postCategory->name ?? __('Danh mục gốc') }}</a>
        @endif
    </div>
</div>
