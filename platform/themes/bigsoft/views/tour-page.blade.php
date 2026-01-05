    <section>
        <div class="tw-py-8 container">

            <h2 class="tw-text-center tw-text-[#374888] tw-text-2xl tw-font-bold">
                TOUR NỔI BẬT HẤP DẪN
            </h2>


            <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-x-6 tw-gap-y-0 tw-mt-3">
                @forelse($tours as $tour)
                <div class="tw-flex tw-flex-col tw-rounded-2xl tw-overflow-hidden tw-border tw-border-[#d1d5db] tw-w-full tw-h-auto tw-transition-all">
                    <div class="lg:tw-max-h-[168px] tw-h-auto">
                        <a href="{{ $tour->url ?? '#' }}">
                            @if($tour->image)
                            <img src="{{ RvMedia::getImageUrl($tour->image, 'high', false, asset('images/no-image.png')) }}"
                                alt="{{ $tour->name }}"
                                class="tw-w-full tw-h-full">
                            @else
                            <img src="{{ asset('storage/theme/image/placeholder-tour.png') }}"
                            alt="{{ $tour->name }}"
                            class="tw-w-full tw-h-full">
                            @endif
                        </a>
                    </div>

                    <div class="listInfoLandTour tw-px-4 tw-py-[10px]">
                        <div class="card-body">
                            <div class="titleLandTour card-title">
                                <a href="{{ $tour->url ?? '#' }}"
                                    class="tw-text-[#3a4b8a] tw-text-[17px] tw-font-bold tw-line-clamp-2 tw-min-h-12">
                                    {{ $tour->name }}
                                </a>
                            </div>
                        </div>

                        <div class="listDetailInfoLandTour tw-text-xs">
                            <!-- Địa điểm -->
                            <div class="localDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                                <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                                    <div>
                                        <svg class="svg-inline--fa fa-location-dot tw-text-[#ef8231] tw-h-[1em] tw-text-sm"
                                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="currentColor"
                                                d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z">
                                            </path>
                                        </svg>
                                        <span class="tw-text-[#4b5563] tw-font-semibold">Địa điểm:</span>
                                    </div>
                                    <span class="tw-text-[#4b5563] tw-font-semibold">
                                        {{ $tour->location }}
                                    </span>
                                </div>
                            </div>

                            <!-- Thời gian -->
                            <div class="timeDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                                <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                                    <div>
                                        <svg class="svg-inline--fa fa-clock tw-text-[#ef8231] tw-h-[1em] tw-text-sm"
                                            aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z">
                                            </path>
                                        </svg>
                                        <span class="tw-text-[#4b5563] tw-font-semibold">Thời gian:</span>
                                    </div>
                                    <span class="tw-text-[#4b5563] tw-font-semibold">
                                        {{ $tour->duration }}
                                    </span>
                                </div>
                            </div>

                            <!-- Khởi hành -->
                            <div class="startDetaiInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                                <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                                    <div>
                                        <svg class="svg-inline--fa fa-hourglass tw-text-[#ef8231] tw-h-[1em] tw-text-sm"
                                            aria-hidden="true" focusable="false" data-prefix="far" data-icon="hourglass"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                            <path fill="currentColor"
                                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48l8 0 0 19c0 40.3 16 79 44.5 107.5L158.1 256 76.5 337.5C48 366 32 404.7 32 445l0 19-8 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l336 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-8 0 0-19c0-40.3-16-79-44.5-107.5L225.9 256l81.5-81.5C336 146 352 107.3 352 67l0-19 8 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L24 0zM192 289.9l81.5 81.5C293 391 304 417.4 304 445l0 19L80 464l0-19c0-27.6 11-54 30.5-73.5L192 289.9zm0-67.9l-81.5-81.5C91 121 80 94.6 80 67l0-19 224 0 0 19c0 27.6-11 54-30.5 73.5L192 222.1z">
                                            </path>
                                        </svg>
                                        <span class="tw-text-[#4b5563] tw-font-semibold">Khởi hành:</span>
                                    </div>
                                    <span class="tw-text-[#4b5563] tw-font-semibold">
                                        {{ $tour->departure }}
                                    </span>
                                </div>
                            </div>

                            <!-- Phương tiện -->
                            <div class="carDetailInfoLandTour tw-my-2 tw-font-medium tw-text-black">
                                <div class="iconLandTour tw-flex tw-items-center tw-justify-between">
                                    <div>
                                        <svg class="svg-inline--fa fa-car-side tw-text-[#ef8231] tw-h-[1em] tw-text-sm"
                                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="car-side"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                            <path fill="currentColor"
                                                d="M171.3 96L224 96l0 96-112.7 0 30.4-75.9C146.5 104 158.2 96 171.3 96zM272 192l0-96 81.2 0c9.7 0 18.9 4.4 25 12l67.2 84L272 192zm256.2 1L428.2 68c-18.2-22.8-45.8-36-75-36L171.3 32c-39.3 0-74.6 23.9-89.1 60.3L40.6 196.4C16.8 205.8 0 228.9 0 256L0 368c0 17.7 14.3 32 32 32l33.3 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l130.7 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l33.3 0c17.7 0 32-14.3 32-32l0-48c0-65.2-48.8-119-111.8-127zM434.7 368a48 48 0 1 1 90.5 32 48 48 0 1 1 -90.5-32zM160 336a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                            </path>
                                        </svg>
                                        <span class="tw-text-[#4b5563] tw-font-semibold">Phương tiện:</span>
                                    </div>
                                    <span class="tw-text-[#4b5563] tw-font-semibold">
                                        {{ $tour->transport }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Giá -->
                        <div class="priceDetailInfoLandTour tw-text-base tw-font-bold tw-text-[#333] tw-leading-5 tw-flex tw-justify-between tw-mt-4">
                            @if($tour->price && $tour->sale_price && $tour->sale_price < $tour->price)
                                <div class="regularPrice tw-line-through tw-font-bold">
                                    {{ number_format($tour->price) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                                </div>
                                <div class="buyPrice tw-text-[#f00] tw-font-bold">
                                    {{ number_format($tour->sale_price) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                                </div>
                                @elseif($tour->price || $tour->sale_price)
                                <div></div>
                                <div class="buyPrice tw-text-[#f00] tw-font-bold">
                                    {{ number_format($tour->sale_price ?? $tour->price) }}<span class="Price-currencySymbol tw-font-bold">₫</span>
                                </div>
                                @else
                                <div class="tw-text-[#f00] tw-font-bold">Liên hệ</div>
                                @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="tw-col-span-full tw-text-center tw-py-10 tw-text-gray-500">
                    Hiện chưa có tour nào được hiển thị.
                </div>
                @endforelse
            </div>

            <div class="tw-mt-8 tw-flex tw-justify-center">
                {!! $tours->links() !!}
            </div>

        </div>
    </section>