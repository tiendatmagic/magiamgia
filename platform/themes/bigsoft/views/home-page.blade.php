 {!! Theme::partial('header') !!}
 @if (Theme::get('section-name'))
 {!! Theme::partial('breadcrumbs') !!}
 @endif

 <div class="container">
   <div class="row">
     <div class="col-lg-12">

      <h3 class="tw-text-2xl tw-font-bold tw-mb-5 tw-text-[#f97e2b]">
        {{ theme_option('home_title', 'Nhà cung cấp nổi bật') }}
      </h3>

      @if(theme_option('home_description'))
      <div class="tw-mb-5 tw-text-gray-700">
        {!! theme_option('home_description') !!}
      </div>
      @endif


       <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 tw-gap-5 tw-mb-5">
         @if(isset($providers) && $providers->count() > 0)
           @foreach($providers as $provider)
           <div
             class="provider-item tw-block tw-bg-white tw-rounded-xl tw-shadow-md tw-border tw-border-gray-100 tw-w-full tw-relative tw-cursor-pointer hover:tw-shadow-xl tw-transition-shadow tw-h-[125px] tw-group tw-overflow-hidden">
             <a href="{{ $provider->getUrl() }}" class="tw-w-full tw-h-full tw-block tw-p-2">
               <div class="tw-w-full tw-h-full tw-overflow-hidden">
                 <img src="{{ RvMedia::getImageUrl($provider->logo, null, false, RvMedia::getDefaultImage()) }}"
                      alt="{{ $provider->name }}"
                      class="tw-w-full tw-h-full tw-object-contain tw-align-middle">
               </div>

               <div
                 class="tw-w-full tw-h-full tw-absolute tw-top-0 tw-left-0 tw-bg-[#ffffffcc] tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-flex tw-items-center tw-justify-center">
                 <p
                   class="tw-text-2xl tw-font-semibold tw-text-[#f97e2b] tw-w-2/3 tw-text-center tw-transform tw-translate-y-[-40%] group-hover:tw-translate-y-0 tw-opacity-0 group-hover:tw-opacity-100 tw-transition-all tw-duration-300 tw-ease-out">
                   Mã giảm giá {{ $provider->name }}
                 </p>
               </div>
             </a>
           </div>
           @endforeach
         @endif
       </div>

       {{-- Slider --}}
       @php($homeSliders = json_decode(theme_option('home_sliders', '[]'), true) ?: [])
       @if(count($homeSliders) > 0)
       <div class="tw-my-5">
         <div id="home-slide" class="swiper tw-relative tw-overflow-hidden">
           <div class="swiper-wrapper">
             @foreach($homeSliders as $slider)
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="{{ $slider['url'] ?? '#' }}" rel="nofollow" class="tw-block">
                 <img src="{{ !empty($slider['image']) ? RvMedia::getImageUrl($slider['image'], null, false, RvMedia::getDefaultImage()) : RvMedia::getDefaultImage() }}" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             @endforeach
           </div>
         </div>

         <script>
           document.addEventListener('DOMContentLoaded', function() {
             if (typeof Swiper !== 'undefined') {
               new Swiper('#home-slide', {
                 slidesPerView: 'auto',
                 spaceBetween: 12,
                 freeMode: true,
                 grabCursor: true,
                 autoplay: {
                   delay: 2500,
                   disableOnInteraction: false,
                 },
                 speed: 500,
                 loop: true,
               });
             }
           });
         </script>
       </div>
       @endif
        {{-- Slider --}}

       <div>
         <!-- mã giảm giá hot -->
       </div>


     </div>
   </div>
 </div>

 {!! Theme::partial('footer') !!}