<section class="section-blog tw-bg-white">
  <div class="tw-py-20 container">
    <h3
      class="tw-text-orange-500 tw-font-medium tw-text-base tw-capitalize tw-mb-5 tw-leading-snug tw-text-center wow fadeInUp">
      {{ $subtitle }}
    </h3>
    <h2 class="tw-text-black tw-font-medium tw-text-5xl tw-leading-tight tw-text-center fadeInUp">
      <span class="tw-font-medium tw-text-4xl lg:tw-text-5xl">{{ $title_normal }}</span>
      <span class="tw-text-orange-500 tw-font-medium tw-text-4xl lg:tw-text-5xl"> {{ $title_highlight }}</span>
    </h2>
    <div class="tw-text-base tw-my-5 tw-text-center wow fadeInUp container">
      {!! $description !!}
    </div>

    @if ($posts->count())
    {{-- Mobile: Swiper Slider --}}
    <div class="swiper blog-swiper-mobile tw-block md:tw-hidden tw-overflow-hidden">
      <div class="swiper-wrapper tw-py-16">
        @foreach ($posts as $post)
        <div class="swiper-slide tw-flex-shrink-0 tw-w-60">
          <article
            class="tw-bg-white tw-rounded-2xl tw-shadow-xl tw-overflow-hidden hover:tw-shadow-2xl tw-border tw-border-gray-100 tw-transition">
            <div class="tw-block">
              <div class="tw-h-48 tw-bg-gray-100 tw-overflow-hidden">
                @if ($post->image)
                <a
                  href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
                  <img src="{{ RvMedia::getImageUrl($post->image, 'medium') }}" alt="{{ $post->name }}"
                    class="tw-w-full tw-h-full tw-object-cover tw-transition-transform tw-duration-500 hover:tw-scale-110">
                </a>
                @else
                <a
                  href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
                  <div
                    class="tw-h-48 tw-bg-gradient-to-br tw-from-orange-100 tw-to-orange-200 tw-flex tw-items-center tw-justify-center">
                    <span class="tw-text-4xl tw-font-bold tw-text-orange-600">B</span>
                  </div>
                </a>
                @endif
              </div>
              <div class="tw-p-5">
                <h3
                  class="hover:tw-text-orange-500 tw-text-lg tw-font-semibold tw-line-clamp-2 tw-mb-2 tw-text-gray-800 tw-h-14">
                  <a
                    href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
                    {{ $post->name }}
                  </a>
                </h3>
                <p class="tw-text-sm tw-text-gray-600 tw-line-clamp-2">
                  {{ Str::limit(strip_tags($post->description), 70) }}
                </p>
              </div>
            </div>
          </article>
        </div>
        @endforeach
      </div>

      {{-- Nút điều hướng mobile --}}
      <div class="swiper-button-prev blog-prev-mobile"></div>
      <div class="swiper-button-next blog-next-mobile"></div>
    </div>

    {{-- Desktop: Grid (giữ nguyên) --}}
    <div class="tw-hidden md:tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-6">
      @foreach ($posts as $post)
      <article
        class="tw-bg-white tw-rounded-2xl tw-shadow-xl tw-overflow-hidden tw-group hover:tw-shadow-2xl tw-border tw-border-gray-100 tw-transition">
        <div class="tw-block">
          <div class="tw-h-48 tw-bg-gray-100 tw-overflow-hidden">
            @if ($post->image)
            <a
              href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
              <img src="{{ RvMedia::getImageUrl($post->image, 'medium') }}" alt="{{ $post->name }}"
                class="tw-w-full tw-h-full tw-object-cover tw-transition-transform tw-duration-500 group-hover:tw-scale-110">
            </a>
            @else
            <a
              href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
              <div
                class="tw-h-48 tw-bg-gradient-to-br tw-from-orange-100 tw-to-orange-200 tw-flex tw-items-center tw-justify-center">
                <span class="tw-text-4xl tw-font-bold tw-text-orange-600">B</span>
              </div>
            </a>
            @endif
          </div>
          <div class="tw-p-5">
            <h3
              class="group-hover:tw-text-orange-500 tw-text-lg tw-font-semibold tw-line-clamp-2 tw-mb-2 tw-text-gray-800 tw-h-14">
              <a
                href="{{ preg_match('/\.html$/i', $post->url) ? preg_replace('/(\.html)+$/i', '.html', $post->url) : $post->url . '.html' }}">
                {{ $post->name }}
              </a>
            </h3>
            <p class="tw-text-sm tw-text-gray-600 tw-line-clamp-2">
              {{ Str::limit(strip_tags($post->description), 70) }}
            </p>
          </div>
        </div>
      </article>
      @endforeach
    </div>
    @else
    <p class="tw-text-center tw-text-gray-500">Chưa có bài viết nào.</p>
    @endif

    <div class="tw-text-center tw-mt-10 wow fadeInUp">
      <a href="/blog" class="bg-default tw-inline-block tw-py-4 tw-px-7 tw-rounded-full tw-text-white tw-text-lg">
        Xem tất cả bài viết
      </a>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    new Swiper('.blog-swiper-mobile', {
      slidesPerView: 'auto',
      spaceBetween: 16,
      centeredSlides: false,
      loop: true,
      speed: 600,
      grabCursor: true,
      freeMode: {
        enabled: true,
        momentum: true,
        momentumRatio: 1,
        momentumVelocityRatio: 1,
      },
      navigation: {
        nextEl: '.blog-next-mobile',
        prevEl: '.blog-prev-mobile',
      },
      watchOverflow: true,
      preloadImages: false,
      lazy: true,
    });



  });
</script>

<style>
  .blog-swiper-mobile {
    padding: 1rem 0;
    position: relative;
    overflow: hidden;
  }

  .blog-swiper-mobile .swiper-slide {
    width: 240px !important;
    transition: transform 0.3s ease;
  }

  .blog-swiper-mobile .swiper-slide:hover {
    transform: translateY(-4px);
  }

  .blog-prev-mobile,
  .blog-next-mobile {
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    top: 50%;
    margin-top: -20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10;
  }

  .blog-prev-mobile::after,
  .blog-next-mobile::after {
    font-size: 18px;
    color: #ea580c;
    font-weight: bold;
  }

  .blog-swiper-mobile:hover .blog-prev-mobile,
  .blog-swiper-mobile:hover .blog-next-mobile {
    opacity: 1;
    visibility: visible;
  }

  .blog-prev-mobile {
    left: 8px;
  }

  .blog-next-mobile {
    right: 8px;
  }

  /* Luôn hiện nút trên mobile */
  @media (pointer: coarse) {

    .blog-prev-mobile,
    .blog-next-mobile {
      opacity: 1;
      visibility: visible;
    }
  }

  .swiper-slide img {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transform: translateZ(0);
  }

  .swiper-button-disabled {
    opacity: 0.3 !important;
    cursor: not-allowed;
  }
</style>