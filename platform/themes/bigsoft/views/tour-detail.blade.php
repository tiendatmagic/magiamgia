<section>
    <div class="tw-py-5 container">
        <div class="lightgallery">
            <div class="row g-2 overflow-hidden rounded">
                @if($tour->image)
                    <div class="col-md-6">
                        <a href="{{ RvMedia::getImageUrl($tour->image) }}" data-fancybox="gallery" class="d-block position-relative h-100">
                            <img src="{{ RvMedia::getImageUrl($tour->image, 'high', false, asset('images/no-image.jpg')) }}"
                                  class="img-fluid w-100 h-100 object-fit-cover rounded group-hover:tw-scale-[1.03] tw-transition-all" style="aspect-ratio: 4/3;">
                        </a>
                    </div>

                    <div class="col-md-6">
                        <div class="row g-2 h-100">
                            <!-- Bạn có thể thêm gallery ảnh phụ ở đây sau -->
                            <div class="col-6">
                                <a href="{{ RvMedia::getImageUrl($tour->image) }}" data-fancybox="gallery" class="d-block position-relative">
                                    <img src="{{ RvMedia::getImageUrl($tour->image, 'high') }}" class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.03] tw-transition-all" style="aspect-ratio: 1/1;">
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ RvMedia::getImageUrl($tour->image) }}" data-fancybox="gallery" class="d-block position-relative">
                                    <img src="{{ RvMedia::getImageUrl($tour->image, 'high') }}" class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.03] tw-transition-all" style="aspect-ratio: 1/1;">
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ RvMedia::getImageUrl($tour->image) }}" data-fancybox="gallery" class="d-block position-relative">
                                    <img src="{{ RvMedia::getImageUrl($tour->image, 'high') }}" class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.03] tw-transition-all" style="aspect-ratio: 1/1;">
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ RvMedia::getImageUrl($tour->image) }}" data-fancybox="gallery" class="d-block position-relative">
                                    <img src="{{ RvMedia::getImageUrl($tour->image, 'thumb') }}" class="img-fluid w-100 h-100 object-fit-cover rounded hover:tw-scale-[1.03] tw-transition-all" style="aspect-ratio: 1/1;">
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500">Chưa có ảnh tour</p>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="tw-mb-5 container">
    <div class="tw-flex tw-gap-5 tw-flex-col lg:tw-flex-row">
        <!-- Nội dung chính bên trái -->
        <div class="tw-full lg:tw-w-2/3">
            <!-- Thông tin cơ bản -->
            <section>
                <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
                    <div class="tw-mb-3">
                        <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">
                            {{ $tour->name }}
                        </h1>
                    </div>
                    <hr>
                    <div class="tw-py-3 tw-text-base">
                        {!! $tour->description ?? 'Chưa có mô tả tour.' !!}
                    </div>
                    <hr>

                    <div class="detailListInfoTour tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-mt-5 tw-gap-5 tw-text-base">
                        <span class="iconTour tw-w-full">
                            <svg class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-clock" ...>...</svg>
                            Thời gian: <span>{{ $tour->duration ?? 'Hằng ngày' }}</span>
                        </span>
                        <span class="iconTour tw-w-full">
                            <svg class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-hourglass" ...>...</svg>
                            Khởi hành: <span>{{ $tour->departure ?? 'Hằng ngày' }}</span>
                        </span>
                        <span class="iconTour tw-w-full">
                            <svg class="tw-text-[#f19135] tw-w-5 tw-h-5 tw-mr-2 svg-inline--fa fa-car-side" ...>...</svg>
                            Phương tiện: <span>{{ $tour->transport ?? 'Xe, Cano' }}</span>
                        </span>
                    </div>
                </div>
            </section>

            <!-- Nút hành động (giá người lớn/trẻ em, tải lịch trình, booking) -->
            <section class="tw-mt-5">
                <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 xl:tw-grid-cols-4 tw-gap-5">
                        <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                            <span class="tw-text-white tw-font-bold">
                                Người lớn: {{ number_format($tour->sale_price ?? $tour->price ?? 0) }}₫
                            </span>
                        </div>
                        <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                            <span class="tw-text-white tw-font-bold">
                                Trẻ em: {{ number_format(($tour->sale_price ?? $tour->price ?? 0) * 0.7) }}₫ <!-- Giả sử trẻ em 70% -->
                            </span>
                        </div>
                        <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                            <span class="tw-text-white tw-font-bold">Tải lịch trình</span>
                        </div>
                        <div class="tw-bg-[#3a4b8a] tw-p-3 tw-text-center tw-w-full tw-rounded-full">
                            <span class="tw-text-white tw-font-bold">Booking</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Nội dung chi tiết (lịch trình, chính sách...) -->
            <section class="tw-mt-5">
                <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
                    <div class="tw-mb-3">
                        <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">
                            Thông tin {{ $tour->name }}
                        </h1>
                    </div>
                    <hr>
                    <div class="detailFullSingleTour tw-py-3 tw-text-base">
                        {!! $tour->description ?? 'Chưa có thông tin chi tiết.' !!}
                    </div>
                </div>
            </section>

            <!-- Chính sách tour -->
            <section class="tw-mt-5">
                <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
                    <div class="tw-mb-3">
                        <h1 class="tw-text-[#374888] tw-text-[26px] tw-font-semibold">
                            Chính sách {{ $tour->name }}
                        </h1>
                    </div>
                    <hr>
                    <div class="policySingleTour tw-py-3 tw-text-base">
                        <!-- Bạn có thể thêm field policy vào description hoặc tách riêng -->
                        {!! $tour->description ?? 'Chưa có chính sách.' !!}
                    </div>
                </div>
            </section>
        </div>

        <!-- Form booking bên phải -->
        <div class="tw-full lg:tw-w-1/3">
            <section>
                <div class="tw-shadow-md tw-p-5 lg:tw-p-6 tw-rounded-2xl tw-border tw-border-gray-200">
                    <div class="tw-mb-3">
                        <div class="pricebuyTour tw-text-[#f00] tw-text-[30px] tw-font-medium tw-text-center">
                            {{ number_format($tour->sale_price ?? $tour->price ?? 0) }}<span class="Price-currencySymbol tw-text-base">₫</span>
                            <span class="numberPeople tw-text-base"> / người lớn</span>
                            <br>
                            {{ number_format(($tour->sale_price ?? $tour->price ?? 0) * 0.7) }}<span class="Price-currencySymbol tw-text-base">₫</span>
                            <span class="numberPeople tw-text-base"> / trẻ em</span>
                        </div>
                    </div>

                    <div class="contactFormTour tw-pt-3 tw-text-base">
                        <form action="" method="POST"> <!-- Thay route thật -->
                            @csrf
                            <input type="hidden" name="title_tour" value="{{ $tour->name }}">

                            <div class="mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <input type="number" class="form-control" name="adults" placeholder="Người lớn" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="number" class="form-control" name="children" placeholder="Trẻ em">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <input type="tel" class="form-control" name="phone" placeholder="Số điện thoại" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="note" rows="3" placeholder="Ghi chú thêm"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary tw-m-0 tw-bg-[#374888] tw-border-none">
                                    <strong>Đặt ngay</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
