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
.error-page ul li {
  margin-bottom: 5px;
}
</style>
<section class="section pt-50 pb-50">
  <div class="container">
    <div class="page-content error-page">
      @if ($notFoundImage)
      <div class="tw-mb-4">
        <div class="tw-w-full tw-max-w-md tw-mx-auto">
          {{ RvMedia::image($notFoundImage, $notFoundTitle ?: __('404 - Not found')) }}
        </div>
      </div>
      @endif


      @if ($notFoundTitle)
      <h4>{{ $notFoundTitle }}</h4>
      @endif

      @if ($notFoundContent)
      <div class="tw-mt-2">{!! BaseHelper::clean(nl2br($notFoundContent)) !!}</div>
      @endif

      <div class="tw-mx-auto tw-mt-6 tw-text-center">
        <a href="{{ BaseHelper::getHomepageUrl() }}"
          class="tw-py-[13px] tw-px-[20px] tw-text-white lg:tw-m-0 tw-inline tw-border-0 tw-overflow-hidden tw-cursor-pointer tw-no-underline tw-bg-[#005ae0] hover:tw-bg-[#f97e2b] tw-rounded-full tw-font-medium">QUAY
          VỀ TRANG CHỦ</a>
      </div>

    </div>
  </div>
</section>

<style>
header,
footer {
  display: none;
}
</style>

{!! Theme::partial('footer') !!}