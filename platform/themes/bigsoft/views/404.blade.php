@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
    Theme::breadcrumb()->add(SeoHelper::getTitle());

    $notFoundTitle = theme_option('404_page_title');
    $notFoundContent = theme_option('404_page_content');
    $notFoundImage = theme_option('404_page_image');
@endphp

{!! Theme::partial('header') !!}
{!! Theme::partial('breadcrumbs') !!}

<style>
    .error-code {
        color: #22292f;
        font-size: 6rem;
    }

    .error-border {
        background-color: var(--color-1st);
        height: .25rem;
        width: 6rem;
        margin-bottom: 1.5rem;
    }

    .error-page a {
        color: var(--color-1st);
    }

    .error-page ul li {
        margin-bottom : 5px;
    }
</style>
<section class="section pt-50 pb-50">
    <div class="container">
        <div class="page-content error-page">
            @if ($notFoundImage)
                <div class="tw-mb-4">
                    {{ RvMedia::image($notFoundImage, $notFoundTitle ?: __('404 - Not found')) }}
                </div>
            @endif

            <div class="error-code">
                404
            </div>

            <div class="error-border"></div>

            @if ($notFoundTitle)
                <h4>{{ $notFoundTitle }}</h4>
            @else
                <h4>{{ __('This may have occurred because of several reasons') }}:</h4>
            @endif

            @if ($notFoundContent)
                <div class="tw-mt-2">{!! BaseHelper::clean(nl2br($notFoundContent)) !!}</div>
            @else
                <ul>
                    <li>{{ __('The page you requested does not exist.') }}</li>
                    <li>{{ __('The link you clicked is no longer.') }}</li>
                    <li>{{ __('The page may have moved to a new location.') }}</li>
                    <li>{{ __('An error may have occurred.') }}</li>
                    <li>{{ __('You are not authorized to view the requested resource.') }}</li>
                </ul>
                <br>
            @endif

            <strong>{!! BaseHelper::clean(__('Please try again in a few minutes, or alternatively return to the homepage by <a href=":link">clicking here</a>.', ['link' => BaseHelper::getHomepageUrl()])) !!}</strong>
        </div>
    </div>
</section>
{!! Theme::partial('footer') !!}
