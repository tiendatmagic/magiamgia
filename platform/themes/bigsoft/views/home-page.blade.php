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
                 alt="{{ $provider->name }}" class="tw-w-full tw-h-full tw-object-contain tw-align-middle">
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
                 <img
                   src="{{ !empty($slider['image']) ? RvMedia::getImageUrl($slider['image'], null, false, RvMedia::getDefaultImage()) : RvMedia::getDefaultImage() }}"
                   alt="banner" class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
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
         @if(isset($hotVouchers) && $hotVouchers->count() > 0)
         <h3 class="tw-text-2xl tw-font-bold tw-mb-3 tw-text-[#f97e2b]">
           {{ theme_option('hot_vouchers_title', 'Mã giảm giá hot') }}
         </h3>

         @if(theme_option('hot_vouchers_description'))
         <div class="tw-mb-5 tw-text-gray-700">
           {!! theme_option('hot_vouchers_description') !!}
         </div>
         @endif

         <div class="tw-relative">
           <div id="hot-voucher-loading"
             class="tw-absolute tw-inset-0 tw-bg-white/70 tw-backdrop-blur-[1px] tw-z-10 tw-rounded-lg tw-items-center tw-justify-center"
             style="display:none;">
             <div class="tw-flex tw-items-center tw-gap-3 tw-text-gray-700 tw-font-medium">
               <svg class="tw-animate-spin tw-h-5 tw-w-5 tw-text-[#f97e2b]" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24">
                 <circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                 <path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
               </svg>
               <span>{{ __('plugins/voucher::voucher.public.loading') }}</span>
             </div>
           </div>

           <div id="hot-voucher-list"
             class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-3 tw-mb-5"
             data-offset="{{ $hotVouchers->count() }}">
             @foreach($hotVouchers as $voucher)
             <div class="tw-h-full">
               @include('plugins/voucher::public.partials.voucher-items', [
               'vouchers' => collect([$voucher]),
               'provider' => $voucher->provider,
               ])
             </div>
             @endforeach
           </div>
         </div>

         <div class="tw-text-center tw-mt-4">
           <div id="loadMoreHot"
             class="see-more tw-rounded-2xl tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer">
             <svg class="arrows" width="60" height="72" viewBox="0 0 60 72" fill="none"
               xmlns="http://www.w3.org/2000/svg">
               <path d="M0 0 L30 32 L60 0" class="a1" stroke="currentColor" stroke-width="2" fill="none"></path>
               <path d="M0 20 L30 52 L60 20" class="a2" stroke="currentColor" stroke-width="2" fill="none"></path>
               <path d="M0 40 L30 72 L60 40" class="a3" stroke="currentColor" stroke-width="2" fill="none"></path>
             </svg>
             <p class="tw-text-[14px] tw-leading-[21px] js-loadmore-label">
               {{ __('plugins/voucher::voucher.public.load_more_voucher') }}
             </p>
             <p class="tw-text-[14px] tw-leading-[21px] js-loadmore-loading" style="display:none;">
               {{ __('plugins/voucher::voucher.public.loading') }}
             </p>
           </div>
         </div>

         <script>
           (function() {
             const list = document.getElementById('hot-voucher-list');
             const loadingEl = document.getElementById('hot-voucher-loading');
             const loadMoreEl = document.getElementById('loadMoreHot');
             if (!list || !loadMoreEl) return;

             const loadMoreLoading = loadMoreEl.querySelector('.js-loadmore-loading');
             const loadMoreLabel = loadMoreEl.querySelector('.js-loadmore-label');
             const route = '{{ route('public.ajax.voucher.load-more-hot') }}';
             const initialOffset = parseInt(list.getAttribute('data-offset') || '0', 10);

             let state = {
               offset: initialOffset,
               loading: false,
             };

             const setLoading = function(isLoading) {
               if (loadingEl) {
                 loadingEl.style.display = isLoading ? 'flex' : 'none';
               }
               loadMoreEl.classList.toggle('tw-opacity-70', isLoading);
               loadMoreEl.classList.toggle('tw-cursor-not-allowed', isLoading);
               loadMoreEl.classList.toggle('tw-pointer-events-none', isLoading);
               if (loadMoreLoading) loadMoreLoading.style.display = isLoading ? 'block' : 'none';
               if (loadMoreLabel) loadMoreLabel.style.display = isLoading ? 'none' : 'block';
             };

             const setButtonState = function(hasMore) {
               loadMoreEl.style.display = hasMore ? 'flex' : 'none';
             };

             const renderHtml = function(html) {
               const tmp = document.createElement('div');
               tmp.innerHTML = html;
               while (tmp.firstChild) {
                 list.appendChild(tmp.firstChild);
               }
             };

             const fetchVouchers = async function() {
               if (state.loading) return;
               state.loading = true;
               setLoading(true);

               try {
                 const url = new URL(route, window.location.origin);
                 url.searchParams.set('offset', String(state.offset));
                 url.searchParams.set('limit', '9');

                 const res = await fetch(url.toString(), {
                   headers: {
                     'Accept': 'application/json'
                   }
                 });
                 const data = await res.json();
                 const payload = data.data || data;

                 if (payload && typeof payload.html === 'string') {
                   renderHtml(payload.html);

                   const received = payload.count || 0;
                   state.offset += received;
                   list.setAttribute('data-offset', String(state.offset));

                   const hasMore = received >= 9;
                   setButtonState(hasMore);
                 }
               } catch (e) {
                 // ignore
               } finally {
                 state.loading = false;
                 setLoading(false);
               }
             };

             loadMoreEl.addEventListener('click', function() {
               fetchVouchers();
             });

             // Hide load more button if initial count is less than 18
             if (initialOffset < 18) {
               loadMoreEl.style.display = 'none';
             }

             // Toggle coupon detail overlay
             document.addEventListener('click', function(e) {
               const couponCard = e.target.closest('.coupon-card');
               if (!couponCard) return;
               const detail = couponCard.querySelector('.coupon-detail');
               if (!detail) return;

               const willOpen = detail.classList.contains('tw-hidden');

               document.querySelectorAll('.coupon-card .coupon-detail:not(.tw-hidden)').forEach(function(el) {
                 el.classList.add('tw-hidden');
                 const parent = el.closest('.coupon-card');
                 if (parent) parent.classList.remove('tw-z-50');
               });

               if (willOpen) {
                 detail.classList.remove('tw-hidden');
                 couponCard.classList.add('tw-z-50');
               }
             });
           })();
         </script>
         @endif
         <!-- mã giảm giá hot -->
       </div>

       <div>
         <!-- câu hỏi thường gặp accordion -->
         @php($homeFaqs = json_decode(theme_option('home_faqs', '[]'), true) ?: [])
         @if(! empty($homeFaqs))
         <div class="tw-bg-[#fbfbfb] tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5 tw-my-5">
           <div>
             <h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#F9993C]">
               {{ theme_option('home_faqs_title', 'Câu hỏi thường gặp') }}
             </h4>
           </div>

           @if(theme_option('home_faqs_description'))
           <div class="tw-mb-4 tw-text-gray-700">
             {!! theme_option('home_faqs_description') !!}
           </div>
           @endif

           <div class="tw-mx-auto tw-w-full">
             <div class="accordion" id="accordionHomeFaq">
              <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
               @foreach($homeFaqs as $item)
               @if(! empty($item['question'] ?? '') || ! empty($item['answer'] ?? ''))
               <div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseHomeFaq{{ $loop->iteration }}" aria-expanded="false"
                      aria-controls="collapseHomeFaq{{ $loop->iteration }}">
                      <div class="tw-line-clamp-1"> {{ $item['question'] ?? '' }}</div>
                    </button>
                  </h2>
                  <div id="collapseHomeFaq{{ $loop->iteration }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionHomeFaq">
                    <div class="accordion-body">{!! clean($item['answer'] ?? '') !!}</div>
                  </div>
                </div>
               </div>
               @endif
               @endforeach
              </div>
             </div>
           </div>
         </div>
         @endif
         <!-- câu hỏi thường gặp accordion -->
       </div>

       <div>
        {{-- tin khuyến mãi --}}

        {{-- tin khuyến mãi --}}
       </div>

     </div>
   </div>
 </div>

