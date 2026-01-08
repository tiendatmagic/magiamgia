@if (!empty($groups) && count($groups))
  @foreach ($groups as $group)
    @php
      $groupCategory = $group['category'] ?? null;
      $items = $group['items'] ?? null;
    @endphp

    @if ($groupCategory && $items && $items->count())
      <section>
        <div class="tw-py-8 container">

          <h3 class="tw-text-center tw-text-[#374888] tw-text-2xl tw-font-bold">
            {{ $groupCategory->name }}
          </h3>

          <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-6 tw-mt-3">
            @foreach ($items as $item)
              @php
                $href = $item->url ?? null;
                $image = $item->image ?? null;

                $location = $item->location ?? null;
                $duration = $item->duration ?? null;
                $departure = $item->departure_time ?? null;
                $vehicle = $item->vehicle ?? null;

                $originalPrice = $item->original_price ?? null;
                $adultPrice = $item->adult_price ?? null;

                $formatMoney = function ($value) {
                  if ($value === null || $value === '') {
                    return null;
                  }

                  $number = is_numeric($value) ? (float) $value : null;
                  if ($number === null) {
                    return null;
                  }

                  return number_format($number, 0, ',', '.');
                };
              @endphp

              <div class="tw-flex tw-flex-col tw-rounded-2xl tw-overflow-hidden tw-border tw-border-[#d1d5db] tw-w-full tw-h-auto tw-transition-all">
                <div class="lg:tw-max-h-[168px] tw-h-auto">
                  <a href="{{ $href }}">
                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $item->name }}" style="display: block;" class="tw-w-full tw-h-full" onerror="this.onerror=null;this.src='{{ asset('storage/news/1.jpg') }}';">
                  </a>
                </div>

                <div class="listInfoLandTour tw-px-4 tw-py-[10px]">
                  <div class="card-body">
                    <div class="titleLandTour card-title">
                      <a href="{{ $href }}" class="tw-text-[#3a4b8a] tw-text-[17px] tw-font-medium tw-line-clamp-2 tw-min-h-12">
                        {{ $item->name }}
                      </a>
                    </div>
                  </div>

                  <div class="listDetailInfoLandTour tw-text-xs">
                    @if ($location)
                      <div class="localDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                        <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                          <div>
                            <svg class="svg-inline--fa fa-location-dot tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                              <path fill=" currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
                            </svg>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.location') }}:</span>
                          </div>
                          <span class="tw-text-[#4b5563] tw-font-semibold">{{ $location }}</span>
                        </div>
                      </div>
                    @endif

                    @if ($duration)
                      <div class="timeDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                        <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                          <div>
                            <svg class="svg-inline--fa fa-clock tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                            </svg>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.duration') }}:</span>
                          </div>
                          <span class="tw-text-[#4b5563] tw-font-semibold">{{ $duration }}</span>
                        </div>
                      </div>
                    @endif

                    @if ($departure)
                      <div class="startDetaiInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                        <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                          <div>
                            <svg class="svg-inline--fa fa-hourglass tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="far" data-icon="hourglass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48l8 0 0 19c0 40.3 16 79 44.5 107.5L158.1 256 76.5 337.5C48 366 32 404.7 32 445l0 19-8 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l336 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-8 0 0-19c0-40.3-16-79-44.5-107.5L225.9 256l81.5-81.5C336 146 352 107.3 352 67l0-19 8 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L24 0zM192 289.9l81.5 81.5C293 391 304 417.4 304 445l0 19L80 464l0-19c0-27.6 11-54 30.5-73.5L192 289.9zm0-67.9l-81.5-81.5C91 121 80 94.6 80 67l0-19 224 0 0 19c0 27.6-11 54-30.5 73.5L192 222.1z"></path>
                            </svg>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.departure') }}:</span>
                          </div>
                          <span class="tw-text-[#4b5563] tw-font-semibold">{{ $departure }}</span>
                        </div>
                      </div>
                    @endif

                    @if ($vehicle)
                      <div class="carDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                        <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                          <div>
                            <svg class="svg-inline--fa fa-car-side tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="car-side" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                              <path fill="currentColor" d="M171.3 96L224 96l0 96-112.7 0 30.4-75.9C146.5 104 158.2 96 171.3 96zM272 192l0-96 81.2 0c9.7 0 18.9 4.4 25 12l67.2 84L272 192zm256.2 1L428.2 68c-18.2-22.8-45.8-36-75-36L171.3 32c-39.3 0-74.6 23.9-89.1 60.3L40.6 196.4C16.8 205.8 0 228.9 0 256L0 368c0 17.7 14.3 32 32 32l33.3 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l130.7 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l33.3 0c17.7 0 32-14.3 32-32l0-48c0-65.2-48.8-119-111.8-127zM434.7 368a48 48 0 1 1 90.5 32 48 48 0 1 1 -90.5-32zM160 336a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                            </svg>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.vehicle') }}:</span>
                          </div>
                          <span class="tw-text-[#4b5563] tw-font-semibold">{{ $vehicle }}</span>
                        </div>
                      </div>
                    @endif
                  </div>

                  @if ($originalPrice || $adultPrice)
                    <div class="priceDetailInfoLandTour tw-text-base tw-font-bold tw-text-[#333] tw-leading-5 tw-flex tw-justify-between">
                      <div class="regularPrice tw-line-through tw-font-bold">
                        @if ($originalPrice)
                          {{ $formatMoney($originalPrice) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                        @endif
                      </div>
                      <div class="buyPrice tw-text-[#f00] tw-font-bold">
                        @if ($adultPrice)
                          {{ $formatMoney($adultPrice) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                        @endif
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>

        </div>
      </section>
    @endif
  @endforeach

@else
  <section>
    <div class="tw-py-8 container">

       @if($categoryModel && $categoryModel->description)
      @php
        $descriptionHtml = (string) $categoryModel->description;
        $plainText = trim(preg_replace(
          '/\s+/u',
          ' ',
          strip_tags(html_entity_decode($descriptionHtml, ENT_QUOTES, 'UTF-8'))
        ));
        $words = $plainText === ''
          ? []
          : preg_split('/\s+/u', $plainText, -1, PREG_SPLIT_NO_EMPTY);
        $isLongDescription = count($words) > 250;
      @endphp

      <div class="categoryDescription text-muted mt-3" data-category-description>
        @if ($isLongDescription)
          <div class="tw-relative js-category-desc tw-overflow-hidden tw-max-h-[220px]">
            {!! $descriptionHtml !!}
            <div class="js-category-desc-fade tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-16 tw-bg-gradient-to-b tw-from-transparent tw-to-white"></div>
          </div>

          <div class="tw-mt-4 tw-text-center">
            <button type="button" class="btn btn-primary js-category-desc-more">{{ __('plugins/tour::tour.view_more') }}</button>
            <button type="button" class="btn btn-danger js-category-desc-less tw-hidden">{{ __('plugins/tour::tour.collapse') }}</button>
          </div>

          @once
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                var root = document.querySelector('[data-category-description]');
                if (!root) return;

                var desc = root.querySelector('.js-category-desc');
                var fade = root.querySelector('.js-category-desc-fade');
                var btnMore = root.querySelector('.js-category-desc-more');
                var btnLess = root.querySelector('.js-category-desc-less');

                if (!desc || !btnMore || !btnLess) return;

                var collapsedClasses = ['tw-overflow-hidden', 'tw-max-h-[220px]'];

                function setExpanded(isExpanded) {
                  if (isExpanded) {
                    collapsedClasses.forEach(function (c) { desc.classList.remove(c); });
                    if (fade) fade.classList.add('tw-hidden');
                    btnMore.classList.add('tw-hidden');
                    btnLess.classList.remove('tw-hidden');
                    return;
                  }

                  collapsedClasses.forEach(function (c) { desc.classList.add(c); });
                  if (fade) fade.classList.remove('tw-hidden');
                  btnMore.classList.remove('tw-hidden');
                  btnLess.classList.add('tw-hidden');
                }

                btnMore.addEventListener('click', function () { setExpanded(true); });
                btnLess.addEventListener('click', function () { setExpanded(false); });
              });
            </script>
          @endonce
        @else
          {!! $descriptionHtml !!}
        @endif
      </div>
    @endif

    @if (!empty($sections) && count($sections))
      @foreach($sections as $section)
        @php
          $sectionCategory = $section['category'] ?? null;
          $items = $section['items'] ?? null;
        @endphp

        @if ($sectionCategory && $items)
          <div class="tw-mb-12">
            <h3 class="tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold tw-mb-6">
              {{ $sectionCategory->name }}
            </h3>

            <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-6 tw-mt-2">
              @foreach($items as $item)
                @php
                  $href = null;

                  if (isset($item->url) && $item->url) {
                    $href = $item->url;
                  }

                  if (! $href) {
                    $link = $item->link ?? null;
                    $path = $link && function_exists('tour_public_path') ? tour_public_path($link) : ($link ? '/' . $link : '/');
                    $href = (function_exists('is_plugin_active') && is_plugin_active('language'))
                      ? \Botble\Language\Facades\Language::localizeURL($path)
                      : $path;
                  }

                  $image = $item->image ?? null;

                  $location = $item->location ?? null;
                  $duration = $item->duration ?? null;
                  $departure = $item->departure_time ?? null;
                  $vehicle = $item->vehicle ?? null;

                  $originalPrice = $item->original_price ?? null;
                  $adultPrice = $item->adult_price ?? null;

                  $formatMoney = function ($value) {
                    if ($value === null || $value === '') {
                      return null;
                    }

                    $number = is_numeric($value) ? (float) $value : null;
                    if ($number === null) {
                      return null;
                    }

                    return number_format($number, 0, ',', '.');
                  };
                @endphp

                <div
                  class="tw-flex tw-flex-col tw-rounded-2xl tw-overflow-hidden tw-border tw-border-[#d1d5db] tw-w-full tw-h-auto tw-transition-all">
                  <div class="lg:tw-max-h-[168px] tw-h-auto">
                    <a href="{{ $href }}">
                      <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $item->name }}" style="display: block;"
                        class="tw-w-full tw-h-full" onerror="this.onerror=null;this.src='{{ asset('storage/news/1.jpg') }}';">
                    </a>
                  </div>

                  <div class="listInfoLandTour tw-px-4 tw-py-[10px]">
                    <div class="card-body">
                      <div class="titleLandTour card-title">
                        <a href="{{ $href }}"
                          class="tw-text-[#3a4b8a] tw-text-[17px] tw-font-medium tw-line-clamp-2 tw-min-h-12">
                          {{ $item->name }}
                        </a>
                      </div>
                    </div>

                    <div class="listDetailInfoLandTour tw-text-xs">
                      @if ($location)
                        <div class="localDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                          <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                            <div>
                              <svg class="svg-inline--fa fa-location-dot tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                <path fill=" currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
                              </svg>
                              <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.location') }}:</span>
                            </div>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ $location }}</span>
                          </div>
                        </div>
                      @endif

                      @if ($duration)
                        <div class="timeDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                          <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                            <div>
                              <svg class="svg-inline--fa fa-clock tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
                              </svg>
                              <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.duration') }}:</span>
                            </div>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ $duration }}</span>
                          </div>
                        </div>
                      @endif

                      @if ($departure)
                        <div class="startDetaiInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                          <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                            <div>
                              <svg class="svg-inline--fa fa-hourglass tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="far" data-icon="hourglass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48l8 0 0 19c0 40.3 16 79 44.5 107.5L158.1 256 76.5 337.5C48 366 32 404.7 32 445l0 19-8 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l336 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-8 0 0-19c0-40.3-16-79-44.5-107.5L225.9 256l81.5-81.5C336 146 352 107.3 352 67l0-19 8 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L24 0zM192 289.9l81.5 81.5C293 391 304 417.4 304 445l0 19L80 464l0-19c0-27.6 11-54 30.5-73.5L192 289.9zm0-67.9l-81.5-81.5C91 121 80 94.6 80 67l0-19 224 0 0 19c0 27.6-11 54-30.5 73.5L192 222.1z"></path>
                              </svg>
                              <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.departure') }}:</span>
                            </div>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ $departure }}</span>
                          </div>
                        </div>
                      @endif

                      @if ($vehicle)
                        <div class="carDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                          <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                            <div>
                              <svg class="svg-inline--fa fa-car-side tw-text-[#ef8231] tw-h-[1em] tw-text-sm" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="car-side" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M171.3 96L224 96l0 96-112.7 0 30.4-75.9C146.5 104 158.2 96 171.3 96zM272 192l0-96 81.2 0c9.7 0 18.9 4.4 25 12l67.2 84L272 192zm256.2 1L428.2 68c-18.2-22.8-45.8-36-75-36L171.3 32c-39.3 0-74.6 23.9-89.1 60.3L40.6 196.4C16.8 205.8 0 228.9 0 256L0 368c0 17.7 14.3 32 32 32l33.3 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l130.7 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l33.3 0c17.7 0 32-14.3 32-32l0-48c0-65.2-48.8-119-111.8-127zM434.7 368a48 48 0 1 1 90.5 32 48 48 0 1 1 -90.5-32zM160 336a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                              </svg>
                              <span class="tw-text-[#4b5563] tw-font-semibold">{{ __('plugins/tour::tour.public.vehicle') }}:</span>
                            </div>
                            <span class="tw-text-[#4b5563] tw-font-semibold">{{ $vehicle }}</span>
                          </div>
                        </div>
                      @endif
                    </div>

                    @if ($originalPrice || $adultPrice)
                      <div class="priceDetailInfoLandTour tw-text-base tw-font-bold tw-text-[#333] tw-leading-5 tw-flex tw-justify-between">
                        <div class="regularPrice tw-line-through tw-font-bold">
                          @if ($originalPrice)
                            {{ $formatMoney($originalPrice) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                          @endif
                        </div>
                        <div class="buyPrice tw-text-[#f00] tw-font-bold">
                          @if ($adultPrice)
                            {{ $formatMoney($adultPrice) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                          @endif
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>

            <div class="page-pagination tw-px-4 tw-py-6 tw-text-right">
              {!! $items->withQueryString()->links() !!}
            </div>
          </div>
        @endif
      @endforeach
    @else
      <div class="tw-mb-12">

        <h3 class="tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold tw-mb-6">
          {{ $categoryName ?? ($tourName ?? 'TOUR') }}
        </h3>

        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-6 tw-mt-2">

        @php
          /**
           * Expect either:
           * - $posts: paginated list of blog posts/articles for a tour
           * - or legacy $tour: paginated list of tours for a category
           */
          $items = isset($posts) ? $posts : $tour;
        @endphp

          @foreach($items as $item)
            @php
              // If this is a Blog Post model, prefer its computed URL.
              $href = null;

              if (isset($item->url) && $item->url) {
                $href = $item->url;
              }

              // Legacy fallback: build URL from category slug + tour link.
              if (! $href) {
                $link = $item->link ?? null;
                $path = $link && function_exists('tour_public_path') ? tour_public_path($link) : ($link ? '/' . $link : '/');
                $href = (function_exists('is_plugin_active') && is_plugin_active('language'))
                  ? \Botble\Language\Facades\Language::localizeURL($path)
                  : $path;
              }

              $image = $item->image ?? null;
            @endphp

            <div
              class="tw-flex tw-flex-col tw-rounded-md tw-overflow-hidden tw-border tw-border-[#d1d5db] tw-w-full tw-h-auto tw-transition-all">
              <div class="tw-h-[168px]">
                <a href="{{ $href }}">
                  <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $item->name }}" style="display: block;"
                    class="tw-w-full tw-h-full">
                </a>
              </div>

              <div class="listInfoLandTour tw-px-4 tw-py-[10px]">
                <div class="card-body">
                  <div class="titleLandTour card-title">
                    <a href="{{ $href }}"
                      class="tw-text-[#3a4b8a] tw-text-[17px] tw-font-semibold tw-line-clamp-2 tw-min-h-12 tw-uppercase">
                      {{ $item->name }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>

        {{-- Pagination --}}
        <div class="page-pagination tw-px-4 tw-py-6 tw-text-right">
          {!! $items->withQueryString()->links() !!}
        </div>
      </div>
    @endif

    </div>
  </section>
@endif
