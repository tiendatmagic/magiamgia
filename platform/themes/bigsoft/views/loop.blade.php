@php
	$layout = theme_option('blog_layout', 'default');
	Theme::layout($layout === 'no-sidebar' ? 'default-no-sidebar' : $layout);
@endphp

@include(Theme::getThemeNamespace() . '::views.templates.posts', compact('posts'))
