 {!! Theme::partial('header') !!}
 @if (Theme::get('section-name'))
 {!! Theme::partial('breadcrumbs') !!}
 @endif

 <div class="container">
   <div class="row">
     <div class="col-lg-12">

       <div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-4 lg:tw-grid-cols-5 tw-gap-3 tw-mb-5">
         <div
           class="provider-item tw-block tw-bg-white tw-rounded-xl tw-shadow-md tw-border tw-border-gray-100 tw-w-full  tw-relative tw-cursor-pointer hover:tw-shadow-lg tw-transition-shadow tw-h-[125px] tw-group tw-overflow-hidden">
           <a href="###" class="tw-w-full tw-h-full tw-block tw-p-2">
             <div class="tw-w-full tw-h-full tw-overflow-hidden">
               <img src="https://magiamgia.com/wp-content/uploads/2020/12/Shopee-1024x536.jpg" alt=""
                 class="tw-w-full tw-h-full tw-object-cover tw-align-middle">
             </div>

             <div
               class="tw-w-full tw-h-full tw-absolute tw-top-0 tw-left-0 tw-bg-[#ffffffcc] tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity tw-flex tw-items-center tw-justify-center">
               <p
                 class="tw-text-2xl tw-font-semibold tw-text-[#f97e2b] tw-w-2/3 tw-text-center tw-transform tw-translate-y-[-40%] group-hover:tw-translate-y-0 tw-opacity-0 group-hover:tw-opacity-100 tw-transition-all tw-duration-300 tw-ease-out">
                 Mã giảm giá Shopee
               </p>
             </div>
           </a>
         </div>
       </div>

       <div class="tw-mt-6">
         <div id="home-slide" class="swiper tw-relative tw-overflow-hidden">
           <div class="swiper-wrapper">
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://sandeal.co/782d20" rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/08-02-2025/trapound-giA-1738988254876.png" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://sandeal.co/f7b1f5" rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/08-02-2025/mark-1738988101485.png" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://pages.lazada.vn/wow/gcp/lazada/channel/vn/khuyen-mai/vouchermax"
                 rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/18-05-2024/Freeship-1715992975745.jpg" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://sandeal.co/5d5786" rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/07-02-2025/hinh-1738919790223.png" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://xomsansale.com/007709" rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/18-05-2024/Tramj-1715993049733.jpg" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
             <div class="swiper-slide tw-w-[170px] sm:tw-w-[186px] md:tw-w-[174px] lg:tw-w-[238px] xl:tw-w-[292px]">
               <a target="_blank" href="https://sandeal.co/Za15EP" rel="nofollow" class="tw-block">
                 <img src="https://images.bloggiamgia.vn/full/08-12-2025/570x888-1765193827097.png" alt="banner"
                   class="tw-rounded-lg tw-w-full tw-h-full tw-object-cover" />
               </a>
             </div>
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

       <div>
         <!-- mã giảm giá hot -->
       </div>


     </div>
   </div>
 </div>

 {!! Theme::partial('footer') !!}