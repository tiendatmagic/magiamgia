@php
    use Carbon\Carbon;
    $provider = $provider ?? null;
    $providerLogo = data_get($provider, 'logo');
    $voucherCollection = collect($vouchers);
@endphp

@if($voucherCollection->isEmpty())
    <div class="tw-col-span-full tw-text-center tw-text-gray-500 tw-py-8">
        <p class="tw-text-base">Chưa có mã giảm giá nào.</p>
    </div>
@else
@foreach($vouchers as $voucher)
@php
    $discountText = $voucher->discount_type === 'percent'
        ? rtrim(rtrim(number_format((float) $voucher->discount_value, 2, '.', ''), '0'), '.') . '%'
        : number_format((float) $voucher->discount_value, 0, '.', ',') . 'đ';
    $categoryLabel = $voucher->category ?: 'Danh mục khác';
    $logo = $voucher->coupon_image ?: $providerLogo;

    $now = Carbon::now()->startOfDay();
    $expiredAt = $voucher->expired_at ? $voucher->expired_at->copy()->startOfDay() : null;
    $daysLeft = $expiredAt ? $now->diffInDays($expiredAt, false) : null;
    $daysLeftSafe = $daysLeft !== null ? max(0, $daysLeft) : null;
    $expiringSoon = $daysLeftSafe !== null && $daysLeftSafe <= 5 && $daysLeftSafe >= 0;

    $expiredDate = $expiredAt ? $expiredAt->format('d/m/Y') : 'Không thời hạn';
    $minOrder = $voucher->min_order ? number_format((float) $voucher->min_order, 0, '.', ',') . 'đ' : 'Không giới hạn';
    $maxDiscount = $voucher->max_discount ? number_format((float) $voucher->max_discount, 0, '.', ',') . 'đ' : '';
    $noteShort = $voucher->note ? Str::limit(strip_tags($voucher->note), 50) : '';
    $noteFull = $voucher->note ? strip_tags($voucher->note) : '';
@endphp
<div class="coupon-card tw-flex tw-bg-white tw-rounded-lg tw-shadow-md tw-overflow-visible tw-border tw-h-full tw-min-h-[140px] tw-border-gray-100 tw-relative tw-cursor-pointer tw-z-10">
    <div class="coupon-left tw-w-2/5 xl:tw-w-1/3 tw-bg-[#f97e2b] tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-white tw-p-2 tw-text-center tw-border-r-2 tw-border-dashed tw-border-white tw-rounded-s-lg tw-relative after:tw-absolute after:tw-w-10 after:tw-h-10 after:tw-rounded-full after:tw-bg-[#fbfbfb] after:tw-top-1/2 after:-tw-translate-y-1/2 after:-tw-left-5">
        <div class="tw-flex tw-flex-col tw-justify-between tw-h-full">
            <div>
                <div class="tw-w-10 tw-h-10 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-mb-1 tw-mx-auto">
                    <img src="{{ $logo ? RvMedia::getImageUrl($logo) : '' }}" alt="{{ $categoryLabel }}" class="tw-min-w-10 tw-min-h-10 tw-w-10 tw-h-10 tw-bg-[#fe5722 tw-border-2 tw-border-solid tw-border-white tw-p-1 tw-rounded-full">
                </div>
                <div class="tw-font-medium tw-text-sm tw-max-w-[100px] tw-mx-auto">
                    {{ $categoryLabel }}
                </div>
            </div>

            <div>
                <div class="tw-text-xs tw-opacity-90 tw-mt-1.5">
                    @if($expiringSoon)
                        <span class="tw-bg-red-500 tw-text-white tw-font-semibold tw-px-2 tw-py-1 tw-rounded-lg tw-text-xs tw-inline-flex tw-items-center tw-gap-1 tw-border tw-border-gray-200">
                            <i class="fa fa-clock"></i>
                            Còn {{ ($daysLeftSafe) }} ngày
                        </span>
                    @else
                        <span>
                            <i class="fa fa-clock"></i>
                            HSD: {{ $expiredDate }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw-w-3/5 xl:tw-w-2/3 tw-rounded-e-lg tw-p-2 tw-flex tw-flex-col tw-justify-between tw-bg-white tw-relative after:tw-absolute after:tw-w-10 after:tw-h-10 after:tw-rounded-full after:tw-bg-[#fbfbfb] after:-tw-translate-y-1/2 after:tw-top-1/2 after:-tw-right-5">
        <div class="tw-flex tw-flex-col tw-justify-between tw-h-full">
            <div>
                <div class="tw-flex tw-items-center tw-text-xs tw-leading-5">
                    <div class="tw-text-xs tw-font-semibold">
                        Giảm
                    </div>

                    <div class="tw-text-lg tw-leading-[28px] md:tw-text-[24px] md:tw-leading-[32px] tw-ml-1 tw-text-[#f97e2b]">
                        <span class="tw-font-bold">{{ $discountText }}</span>
                    </div>
                </div>

                <div class="tw-text-xs tw-leading-4 tw-mb-1">
                    <span class="tw-text-xs">ĐH tối thiểu:</span>
                    <span class="tw-font-semibold">{{ $minOrder }}</span>
                </div>

                <div class="tw-text-xs tw-leading-4 tw-font-medium tw-italic tw-text-gray-500">
                    <span class="tw-text-[#f97e2b] tw-font-medium">Lưu ý:</span> {{ $noteShort }}
                    <span class="tw-text-black tw-font-normal tw-text-[11px] tw-leading-[16px]">Xem chi tiết</span>
                </div>
            </div>

            <div>
                <div class="tw-flex tw-w-full tw-items-center tw-justify-between">
                    <a href="{{ $voucher->apply_url ?: '###' }}" class="tw-text-xs tw-italic tw-underline hover:tw-underline tw-text-[#08bce0]" target="_blank" rel="nofollow">List áp dụng</a>

                    <a href="{{ $voucher->banner_url ?: '###' }}" class="tw-text-xs tw-font-medium tw-px-5 tw-py-1.5 tw-text-white tw-bg-[#d96a09] tw-rounded-lg w-ml-1" target="_blank" rel="nofollow">Đến Banner</a>
                </div>
            </div>
        </div>
    </div>
    <div class="coupon-detail tw-absolute tw-shadow-md tw-rounded-lg tw-top-0 tw-left-0 tw-bg-white tw-w-full tw-p-4 tw-hidden tw-z-10">
        <div class="tw-text-[#f97e2b] tw-font-medium tw-text-3xl">
            Giảm {{ $discountText }}
        </div>

        @if($maxDiscount)
        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">Tối đa:</span>
            <span class="tw-font-semibold">{{ $maxDiscount }}</span>
        </div>
        @endif

        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">ĐH tối thiểu:</span>
            <span class="tw-font-semibold">{{ $minOrder }}</span>
        </div>

        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">Ngành hàng:</span>
            <span class="tw-font-semibold">{{ $categoryLabel }}</span>
        </div>

        <div class="tw-text-sm tw-leading-4 tw-font-medium tw-text-gray-500">
            <p class="tw-text-sm tw-text-[#f97e2b] tw-font-medium">Lưu ý:</p>
            <p class="tw-text-sm tw-text-black tw-font-medium">{{ $noteFull }}</p>
        </div>

        <div class="tw-flex tw-w-full tw-items-center tw-justify-between tw-mt-3">
            <a href="{{ $voucher->apply_url ?: '###' }}" class="tw-text-sm tw-italic tw-underline tw-text-[#08bce0]" target="_blank" rel="nofollow">List áp dụng</a>

            <a href="{{ $voucher->banner_url ?: '###' }}" class="tw-text-sm tw-font-medium tw-px-5 tw-py-1.5 tw-text-white tw-bg-[#d96a09] tw-rounded w-ml-1" target="_blank" rel="nofollow">Đến Banner</a>
        </div>
    </div>
</div>
@endforeach
@endif
