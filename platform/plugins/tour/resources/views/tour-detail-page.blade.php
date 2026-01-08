@php
  $galleryImages = $tour->images ?? [];
  if (is_string($galleryImages) && $galleryImages !== '') {
    $galleryImages = [$galleryImages];
  }
  if (!is_array($galleryImages)) {
    $galleryImages = [];
  }

  $galleryImages = array_values(array_filter($galleryImages, fn ($img) => !empty($img)));

  $mainImage = $galleryImages[0] ?? null;
  $imageUrl = $mainImage ? RvMedia::getImageUrl($mainImage) : null;

  $location = $tour->location ?? null;
  $duration = $tour->duration ?? null;
  $departureTime = $tour->departure_time ?? null;
  $vehicle = $tour->vehicle ?? null;

  $originalPrice = $tour->original_price ?? null;
  $adultPrice = $tour->adult_price ?? null;
  $childPrice = $tour->child_price ?? null;
  $attachment = $tour->attachment ?? null;

  $intro = $tour->intro ?? null;
  $policy = $tour->policy ?? null;

  $formatMoney = function ($value) {
    if ($value === null || $value === '') {
      return null;
    }

    $number = is_numeric($value) ? (float) $value : null;
    if ($number === null) {
      return null;
    }

    $formatted = number_format($number, 0, ',', '.');
    return $formatted . '₫';
  };

  $numberFormat = function ($value) {
    if ($value === null || $value === '') {
      return null;
    }

    $number = is_numeric($value) ? (float) $value : null;
    if ($number === null) {
      return null;
    }

    $formatted = number_format($number, 0, ',', '.');
    return $formatted;
  };


  $contactPhone = function_exists('theme_option') ? theme_option('contact_phone') : null;
  $contactEmail = function_exists('theme_option') ? theme_option('contact_email') : null;
  // Build an itinerary URL pointing to this tour's itinerary page
  $itineraryPrefixes = function_exists('tour_all_locales_slug_prefixes') ? tour_all_locales_slug_prefixes() : ['tour', 'dich-vu'];
  $itineraryPrefix = $itineraryPrefixes[0] ?? 'tour';
  $itineraryUrl = url($itineraryPrefix . '/' . ($tour->link ?? $tour->slug ?? '')) . '/itinerary';
@endphp

@if (!empty($galleryImages))
  <section>
    <div class="tw-py-5 container">
      <div class="lightgallery">
        <div class="row g-2 overflow-hidden rounded">

          <div class="col-md-6">
            <a href="{{ $imageUrl }}" data-fancybox="gallery" class="d-block position-relative h-100">
              <img src="{{ $imageUrl }}"
                class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.02] tw-transition-all" style="aspect-ratio: 4/3;">
            </a>
          </div>

          <div class="col-md-6">
            <div class="row g-2 h-100">
              @for ($i = 1; $i <= 4; $i++)
                @php
                  $thumb = $galleryImages[$i] ?? $mainImage;
                  $thumbUrl = $thumb ? RvMedia::getImageUrl($thumb) : null;
                @endphp

                @if ($thumbUrl)
                  <div class="col-6">
                    <a href="{{ $thumbUrl }}" data-fancybox="gallery" class="d-block position-relative">
                      <img src="{{ $thumbUrl }}"
                        class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.02] tw-transition-all" style="aspect-ratio: 1/1;">
                    </a>
                  </div>
                @endif
              @endfor
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endif

<div class="tw-mb-5 container">
  <div class="tw-flex tw-gap-5 tw-flex-col lg:tw-flex-row">
    <div class="tw-full lg:tw-w-2/3">

      <section>
        <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
          <div class="tw-mb-3">
            <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">
              {{ $tour->name }}
            </h1>
          </div>

          <hr>

          @if (!empty($intro))
            <div class="tw-py-3 tw-text-base">
              {!! $intro !!}
            </div>

            <hr>
          @endif

          <div class="detailListInfoTours tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-mt-5 tw-gap-5 tw-justify-between tw-text-base">

            @if ($duration)
              <span class="iconTour tw-w-full">
                <svg class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-clock" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                </svg>
                {{ __('plugins/tour::tour.public.duration') }}: <span>{{ $duration }}</span>
              </span>
            @endif

            @if ($departureTime)
              <span class="iconTour tw-w-full">
                <svg
                class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-hourglass" aria-hidden="true"
                focusable="false" data-prefix="far" data-icon="hourglass" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512" data-fa-i2svg="">
                <path fill="currentColor"
                  d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48l8 0 0 19c0 40.3 16 79 44.5 107.5L158.1 256 76.5 337.5C48 366 32 404.7 32 445l0 19-8 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l336 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-8 0 0-19c0-40.3-16-79-44.5-107.5L225.9 256l81.5-81.5C336 146 352 107.3 352 67l0-19 8 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L24 0zM192 289.9l81.5 81.5C293 391 304 417.4 304 445l0 19L80 464l0-19c0-27.6 11-54 30.5-73.5L192 289.9zm0-67.9l-81.5-81.5C91 121 80 94.6 80 67l0-19 224 0 0 19c0 27.6-11 54-30.5 73.5L192 222.1z">
                </path>
              </svg>
                {{ __('plugins/tour::tour.public.departure') }}: <span>{{ $departureTime }}</span>
              </span>
            @endif

            @if ($vehicle)
              <span class="iconTour tw-w-full">
                <svg class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-car-side" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="car-side" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M171.3 96L224 96l0 96-112.7 0 30.4-75.9C146.5 104 158.2 96 171.3 96zM272 192l0-96 81.2 0c9.7 0 18.9 4.4 25 12l67.2 84L272 192zm256.2 1L428.2 68c-18.2-22.8-45.8-36-75-36L171.3 32c-39.3 0-74.6 23.9-89.1 60.3L40.6 196.4C16.8 205.8 0 228.9 0 256L0 368c0 17.7 14.3 32 32 32l33.3 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l130.7 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l33.3 0c17.7 0 32-14.3 32-32l0-48c0-65.2-48.8-119-111.8-127zM434.7 368a48 48 0 1 1 90.5 32 48 48 0 1 1 -90.5-32zM160 336a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                </svg>
                {{ __('plugins/tour::tour.public.vehicle') }}: <span>{{ $vehicle }}</span>
              </span>
            @endif

          </div>

        </div>
      </section>

      <section class="tw-mt-5">
        @if ($adultPrice || $childPrice || $attachment)
          <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200 tw-mb-5">
            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 2xl:tw-grid-cols-4 tw-gap-5">
              @if ($adultPrice)
                <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                  <span class="tw-text-white tw-font-bold">{{ __('plugins/tour::tour.public.adult') }}: {{ $formatMoney($adultPrice) }}</span>
                </div>
              @endif

              @if ($childPrice)
                <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                  <span class="tw-text-white tw-font-bold">{{ __('plugins/tour::tour.public.child') }}: {{ $formatMoney($childPrice) }}</span>
                </div>
              @endif

              <button type="button" class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full tw-border-0 tw-cursor-pointer" data-modal-target="downloadItineraryModal">
                <span class="tw-text-white tw-font-bold">{{ __('plugins/tour::tour.public.download_itinerary') }}</span>
              </button>

              <div class="tw-bg-[#3a4b8a] tw-text-center tw-w-full tw-rounded-full">
                <a href="#booking-form-sidebar" class="tw-text-white tw-font-bold tw-no-underline tw-block tw-w-full tw-h-full tw-p-3">
                <span class="tw-text-white tw-font-bold">{{ __('plugins/tour::tour.public.booking') }}</span>
                </a>
              </div>
            </div>
          </div>
        @endif

        <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
          <div class="tw-mb-3">
            <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">{{ __('plugins/tour::tour.public.information', ['name' => $tour->name]) }}</h1>
          </div>

          <hr>

          <div class="detailFullSingleTour tw-py-3 tw-text-base">
            <div class="content">
              <div class="">
                {!! $tour->content !!}
              </div>
            </div>
          </div>

        </div>
      </section>

      @if (!empty($policy))
        <section class="tw-mt-5">
          <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
            <div class="tw-mb-3">
              <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">{{ __('plugins/tour::tour.public.policy', ['name' => $tour->name]) }}</h1>
            </div>

            <hr>

            <div class="policySingleTour tw-py-3 tw-text-base">
              {!! $policy !!}
            </div>
          </div>
        </section>
      @endif

    </div>
    <div class="tw-full lg:tw-w-1/3">

      <section>
        <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200 tw-scroll-mt-32" id="booking-form-sidebar">
          <div class="tw-mb-3">
            <div class="pricebuyTour tw-text-[#f00] tw-text-[30px] tw-font-medium tw-text-center">
               {{ $numberFormat($adultPrice) }}<span class="Price-currencySymbol tw-text-base">₫</span>
                 <span class="numberPeople tw-text-base"> {{ __('plugins/tour::tour.public.per_adult') }}</span>
              <br>
              {{ $numberFormat($childPrice) }}<span class="Price-currencySymbol tw-text-base">₫</span>
                <span class="numberPeople tw-text-base"> {{ __('plugins/tour::tour.public.per_child') }}</span>
            </div>
          </div>

          <div class="contactFormTour tw-pt-3 tw-text-base">
            <div class="card-body">
              @if (function_exists('is_plugin_active') && is_plugin_active('booking'))
                {!! view('plugins/booking::forms.booking', ['model' => $tour, 'tour' => $tour])->render() !!}
              @endif
            </div>
          </div>

        </div>
      </section>

    </div>
  </div>
</div>

<!-- Include Download Modal -->
@include('plugins/tour::itinerary-download-modal')
