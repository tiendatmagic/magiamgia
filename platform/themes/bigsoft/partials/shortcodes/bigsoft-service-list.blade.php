<section>
  <div class="container">
    <div id="singleMain">
      <div class="servicesTitle my-4 text-center">
        @if ($title )
        <h1 class="lg:tw-text-[2.5rem] tw-text-[calc(1.375rem+1.5vw)] tw-font-medium tw-uppercase">
          {{ $title }}
        </h1>
        @endif
      </div>
      <div class="row">
        @foreach($services as $item)
          @php
            $categorySlug = $item->category ?: optional($item->categories->first())->slug;

            $path = $categorySlug && $item->link
              ? '/' . trim($categorySlug, '/') . '/' . trim($item->link, '/')
              : ($item->url ?? '/');

            $href = is_plugin_active('language')
              ? \Botble\Language\Facades\Language::localizeURL($path)
              : $path;
          @endphp
          <div class="listSingleServices col-md-3 col-6">
            <div class="servicesContent card-body text-center">
              <div class="detailSinglepostServices">
                <div class="listDetailServicesThumbnail">
                  <a href="{{ $href }}">
                    <img
                      src="{{ RvMedia::getImageUrl($item->image) }}"
                      class="card-img-top lg:max-h-[170px] tw-h-auto tw-w-full tw-object-fill"
                      alt="{{ $item->name }}"
                      onerror="if(!this.dataset.failed){this.dataset.failed=1;this.src='{{ asset('storage/news/1.jpg') }}';}"
                    >
                  </a>
                </div>
                <div class="listDetailServicesTitle text-center">
                  <a href="{{ $href }}">
                    <strong>{{ $item->name }}</strong>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
