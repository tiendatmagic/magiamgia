<section>
  <div class="tw-py-8 container">

    <h2 class="tw-text-center tw-text-[#3a4b8a] tw-text-2xl tw-font-bold">
      {{ $categoryName ?? ($serviceName ?? 'DỊCH VỤ') }}
    </h2>

    <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-6 tw-mt-2">

      @php
        /**
         * Expect either:
         * - $posts: paginated list of blog posts/articles for a service
         * - or legacy $service: paginated list of services for a category
         */
        $items = isset($posts) ? $posts : $service;
      @endphp

      @foreach($items as $item)
        @php
          // If this is a Blog Post model, prefer its computed URL.
          $href = null;

          if (isset($item->url) && $item->url) {
            $href = $item->url;
          }

          // Legacy fallback: build URL from category slug + service link.
          if (! $href) {
            $categorySlug = $categoryModel?->slug ?? null;
            $link = $item->link ?? null;
            $path = $categorySlug && $link ? '/' . $categorySlug . '/' . $link : ($link ? '/' . $link : '/');
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
    <div class="mt-4 text-center">
      {{ $items->links() }}
    </div>

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
            <button type="button" class="btn btn-primary js-category-desc-more">{{ __('View more') }}</button>
            <button type="button" class="btn btn-danger js-category-desc-less tw-hidden">{{ __('Collapse') }}</button>
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

  </div>
</section>
