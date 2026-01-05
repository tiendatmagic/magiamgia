{!! Theme::partial('header') !!}
@if (Theme::get('section-name'))
{!! Theme::partial('breadcrumbs') !!}
@endif

<section class="section pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="page-content">
                    {!! Theme::content() !!}
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="page-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section>

{!! Theme::partial('footer') !!}