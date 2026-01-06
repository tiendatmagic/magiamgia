@php
	$layout = theme_option('blog_layout', 'default-no-sidebar');
@endphp

@include(Theme::getThemeNamespace() . '::views.templates.posts', compact('posts'))
