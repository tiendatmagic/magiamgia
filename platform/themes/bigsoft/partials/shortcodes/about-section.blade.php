<section class="section-about tw-bg-white">
  <div class="tw-flex tw-py-20 tw-gap-5 tw-flex-col md:tw-flex-row container">
    <div class="w-full md:tw-w-1/2 wow fadeInLeft">
      <div class="tw-w-full tw-mx-auto">
        <img
          src="{{ $ceo_image ? RvMedia::getImageUrl($ceo_image) : asset('storage/theme/image/img-CEO-Bignet.webp') }}"
          alt="" class="tw-max-w-[85%] tw-mx-auto">
      </div>
    </div>
    <div class="w-full md:tw-w-1/2 wow fadeInRight">
      <h3 class="tw-text-orange-500 tw-font-medium tw-text-base tw-capitalize tw-mb-5 tw-leading-snug">
        {{ $subtitle }}
      </h3>

      <h2 class="tw-text-black tw-font-medium tw-text-5xl tw-leading-tight">
        <span class="tw-font-medium tw-text-4xl md:tw-text-5xl">{{ $title_main }}</span>
        <span class="tw-text-orange-500 tw-font-medium tw-text-4xl md:tw-text-5xl">{{ $title_highlight }}</span>
      </h2>

      <div class="tw-text-base tw-my-5">
        {!! $description !!}
      </div>

      <ul class="tw-grid md:tw-grid-cols-2 tw-gap-5">
        @if(!empty($features))
        @foreach($features as $feature)
        <li class="tw-list-none tw-items-center tw-flex tw-gap-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="tw-size-6 tw-text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          {{ ($feature) }}
        </li>
        @endforeach
        @endif
      </ul>

      <div class="tw-my-5">
        <a href="{{ $button_link }}"
          class="bg-default tw-inline-block tw-py-4 tw-px-7 tw-rounded-full tw-text-white tw-text-lg">
          {{ $button_text }}
        </a>
      </div>
    </div>
  </div>
</section>