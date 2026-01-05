<section class="section-partners tw-bg-[#fff4f3]">
    <div class="tw-py-20">
        <h3 class="tw-text-orange-500 tw-font-medium tw-text-base tw-capitalize tw-mb-5 tw-leading-snug tw-text-center wow fadeInUp">
            {{ $subtitle }}
        </h3>

        <h2 class="tw-text-black tw-font-medium tw-text--5xl tw-leading-tight tw-text-center wow fadeInUp">
            <span class="tw-font-medium tw-text-4xl lg:tw-text-5xl">{{ $title_normal }}</span>
            <span class="tw-text-orange-500 tw-font-medium tw-text-4xl lg:tw-text-5xl"> {{ $title_highlight }}</span>
        </h2>

        <div class="tw-text-base tw-my-5 tw-text-center wow fadeInUp container">
            {!! $description !!}
        </div>

        {{-- Swiper Slider --}}
        <div class="swiper partners-swiper container tw-overflow-hidden">
            <div class="swiper-wrapper tw-py-16">
                @foreach ($partners as $p)
                    <div class="swiper-slide tw-flex-shrink-0 tw-w-64">
                        <div class="tw-border tw-border-gray-100 tw-shadow-xl tw-rounded-2xl tw-bg-white hover:tw-shadow-2xl tw-transition wow fadeInUp">
                            <div class="tw-p-5">
                                @if(!empty($p['image']))
                                    <div class="tw-w-auto tw-mx-auto tw-mb-5">
                                        <img src="{{ RvMedia::getImageUrl($p['image']) }}"
                                             alt="{{ $p['name'] }}"
                                             class="tw-w-auto tw-max-h-20 tw-object-contain tw-border-4 tw-border-white tw-shadow-lg tw-mx-auto">
                                    </div>
                                @endif

                                <div class="tw-border-t tw-border-gray-100 tw-pt-5 tw-text-center">
                                    @if(!empty($p['name']))
                                        <h3 class="tw-text-xl tw-font-medium tw-text-gray-900">{{ $p['name'] }}</h3>
                                    @endif

                                    @if(!empty($p['position']))
                                        <p class="tw-text-base tw-text-gray-600 tw-mt-1">{{ $p['position'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Nút điều hướng --}}
            <div class="swiper-button-prev partners-prev"></div>
            <div class="swiper-button-next partners-next"></div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.partners-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            centeredSlides: false,
            loop: {{ count($partners) > 4 ? 'true' : 'false' }},
            speed: 600,
            grabCursor: true,
            freeMode: {
                enabled: true,
                momentum: true,
            },
            navigation: {
                nextEl: '.partners-next',
                prevEl: '.partners-prev',
            },
            watchOverflow: true,
            preloadImages: false,
            lazy: true,
        });
    });
</script>

<style>
    .partners-swiper {
        padding: 1rem 0;
        position: relative;
        overflow: hidden;
    }

    .partners-swiper .swiper-slide {
        width: 256px !important;
        transition: transform 0.3s ease;
    }

    .partners-swiper .swiper-slide:hover {
        transform: translateY(-4px);
    }

    .swiper-button-prev,
    .swiper-button-next {
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
        outline: none;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        font-size: 18px;
        color: #ea580c;
        font-weight: bold;
    }

    .partners-swiper:hover .swiper-button-prev,
    .partners-swiper:hover .swiper-button-next {
        opacity: 1;
        visibility: visible;
    }

    .swiper-button-prev {
        left: 8px;
    }

    .swiper-button-next {
        right: 8px;
    }

    @media (pointer: coarse) {
        .swiper-button-prev,
        .swiper-button-next {
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