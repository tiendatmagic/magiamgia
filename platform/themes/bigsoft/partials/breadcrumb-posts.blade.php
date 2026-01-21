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

    // Determine current last URL segment (slug) to handle optional category base in permalinks
    $currentPath = trim(request()->path(), '/');
    $segments = $currentPath === '' ? [] : explode('/', $currentPath);
    $lastSegment = end($segments) ?: null;

    // If a $category is passed but its slug doesn't match the final URL segment,
    // fall back to showing the humanized final segment so breadcrumbs match the URL.
    $breadcrumbCategory = null;
    if (isset($category) && $category) {
        if (isset($category->slug) && $lastSegment && $category->slug !== $lastSegment) {
            $breadcrumbCategory = (object) [
                'url' => url(request()->path()),
                'name' => ucwords(str_replace('-', ' ', $lastSegment)),
            ];
        } else {
            $breadcrumbCategory = $category;
        }
    }
@endphp

<div class="breadcrumb-all content-section tw-my-1 tw-hidden sm:tw-block container"
    style="--primary-color: {{ theme_option('primary_color', '#AF0F26') }}; --breadcrumb-base: {{ theme_option('primary_color', '#AF0F26') }};">
    <div class="breadcrumb-item tw-flex tw-gap-2 tw-text-sm tw-text-gray-600 tw-mb-3">
        <a href="{{ BaseHelper::getHomepageUrl() }}" class="">Trang chủ</a>

        @if (! empty($breadcrumbCategory))
            <a href="{{ $breadcrumbCategory->url }}" class="">{{ $breadcrumbCategory->name }}</a>
        @elseif (! empty($postCategory))
            <a href="{{ $postCategory->url }}" class="">{{ $postCategory->name ?? __('Danh mục gốc') }}</a>
        @elseif ($blogPage)
            <a href="{{ $blogPage->url }}" class="">{{ $blogPage->name }}</a>
        @endif
    </div>
</div>
