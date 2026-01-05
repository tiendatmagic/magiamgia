{!! Theme::partial('header') !!}
@if (Theme::get('section-name'))
    {!! Theme::partial('breadcrumbs') !!}
@endif

@php
    $path = trim((string) request()->path(), '/');
    $isHomePage = $path === '';

    if (! $isHomePage && function_exists('is_plugin_active') && (is_plugin_active('language') || is_plugin_active('language-advanced'))) {
        try {
            $isHomePage = in_array($path, array_keys(\Botble\Language\Facades\Language::getSupportedLocales()), true);
        } catch (\Throwable) {
            // ignore
        }
    }
@endphp

<style>
    .section-banner, .section-partners {
    position: relative;
    left: 50%;
    right: 50%;
    width: 100vw;
    max-width: calc(100vw - 8px);
    margin-left: -50vw;
    margin-right: -50vw;
}

 .section-banner {
    bottom: 0;
  }

.section-banner img,
.section-banner picture,
.section-banner video {
    display: block;
    width: 100%;
    height: auto;
}

.ck-content .table table th {
    font-weight: 600;
    color: #fff;
    background: #f19135 !important;
    padding: .5rem .5rem !important;
}

.ck-content .table  tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

section.section-banner img {
    height: auto;
}
section.section-banner p {
    margin-bottom: 0 !important;
}

.ck-content .table table td, .ck-content .table table th {
     padding: 1rem !important;
}

.page-content .ck-content ul {
    padding-left: 2rem !important;
}

.ck-content .table table {
    border: inherit;
}

</style>
<section class="section pb-50{{ $isHomePage ? '' : ' pt-50' }}">
    <div class="section-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-content">
                        {!! Theme::content() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{!! Theme::partial('footer') !!}
