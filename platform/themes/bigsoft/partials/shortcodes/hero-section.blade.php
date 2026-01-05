<section class="section-hero tw-bg-[#fff4f3]">
  <div class="container">
    <div class="tw-hero tw-py-20">
      <div class="tw-flex tw-flex-wrap">
        <div class="tw-w-full md:tw-w-1/2 tw-pr-4">
          <h3
            class="tw-text-orange-500 tw-font-medium tw-text-base tw-capitalize tw-mb-5 tw-leading-snug wow fadeInLeft">
            {{ $subtitle }}
          </h3>

          <h1 class="tw-text-black tw-font-medium tw-text-5xl tw-leading-tight tw-my-5">
            <span class="tw-text-orange-500 tw-font-medium tw-block tw-text-4xl md:tw-text-5xl wow fadeInLeft">
              {{ $title_highlight }}
            </span>
            <span class="tw-font-medium tw-block tw-text-4xl md:tw-text-5xl wow fadeInLeft">
              {{ $title }}
            </span>
          </h1>

          <div class="tw-text-base tw-my-5 wow fadeInLeft">
            {!! $description !!}
          </div>

          <div
            class="tw-flex tw-flex-no-wrap tw-gap-6 tw-my-5 tw-flex-col tw-justify-center lg:tw-justify-start tw-items-center sm:tw-flex-row md:tw-whitespace-nowrap wow fadeInLeft">
            <div class="tw-hero-content-footer-btn">
              <a href="{{ $button_link }}"
                class="bg-default tw-inline-block tw-py-4 tw-px-7 tw-rounded-full tw-text-white tw-text-lg">
                {{ $button_text }}
              </a>
            </div>

            @if(!empty($button_text2))
            <div class="tw-hero-content-footer-btn">
              <a href="{{ $button_link2 }}"
                class="bg-default tw-inline-block tw-py-4 tw-px-7 tw-rounded-full tw-text-white tw-text-lg">
                 {{ $button_text2 }}
              </a>
            </div>
            @endif

          </div>
        </div>

        <div class="tw-w-full md:tw-w-1/2 tw-pl-4 tw-mt-8 md:tw-mt-0 wow fadeInRight">
          <div class="tw-w-full tw-mx-auto">
            <img src="{{ RvMedia::getImageUrl($banner_image) }}" alt="" class="tw-max-w-[85%] tw-mx-auto">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>