{!! Theme::partial('header') !!}
@if (Theme::get('section-name'))
    {!! Theme::partial('breadcrumbs') !!}
@endif

@include('theme.bigsoft::views.home-page')

{!! Theme::partial('footer') !!}
