@php
    use Carbon\Carbon;
    $provider = $provider ?? null;
    $providerLogo = data_get($provider, 'logo');
    $voucherCollection = collect($vouchers);
@endphp

@if($voucherCollection->isEmpty())
    <div class="tw-col-span-full tw-text-center tw-text-gray-500 tw-py-8">
        <p class="tw-text-base">{{ __('plugins/voucher::voucher.public.no_voucher') }}</p>
    </div>
@else
@foreach($vouchers as $voucher)
@php
    $discountText = $voucher->discount_type === 'percent'
        ? rtrim(rtrim(number_format((float) $voucher->discount_value, 2, '.', ''), '0'), '.') . '%'
        : number_format((float) $voucher->discount_value, 0, '.', ',') . 'đ';
    $categoryLabel = $voucher->category ?: __('plugins/voucher::voucher.public.other_category');
    $logo = $voucher->coupon_image ?: $providerLogo;

    // Model accessor automatically converts expired_at to GMT+7
    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $expiredAt = $voucher->expired_at; // Already in GMT+7 from model accessor

    // Calculate remaining time in minutes
    $minutesLeft = $expiredAt ? (int) $now->diffInMinutes($expiredAt, false) : null;
    $hoursLeft = $minutesLeft !== null ? (int) floor($minutesLeft / 60) : null;
    $daysLeft = $hoursLeft !== null ? (int) floor($hoursLeft / 24) : null;

    // Safe values (max to 0 if expired)
    $daysLeftSafe = $daysLeft !== null ? max(0, $daysLeft) : null;
    $hoursLeftSafe = $hoursLeft !== null ? max(0, $hoursLeft % 24) : null;
    $minutesLeftSafe = $minutesLeft !== null ? max(0, $minutesLeft % 60) : null;

    // Determine expiry status
    $isExpired = $minutesLeft !== null && $minutesLeft <= 0;
    $showCountdown = !$isExpired && $daysLeftSafe !== null && $daysLeftSafe <= 5;

    $expiredDate = $expiredAt ? $expiredAt->format('d/m/Y') : __('plugins/voucher::voucher.public.no_expiry');
    $minOrder = $voucher->min_order ? number_format((float) $voucher->min_order, 0, '.', ',') . 'đ' : __('plugins/voucher::voucher.public.no_limit');
    $maxDiscount = $voucher->max_discount ? number_format((float) $voucher->max_discount, 0, '.', ',') . 'đ' : '';
    $noteShort = $voucher->note ? Str::limit(strip_tags($voucher->note), 50) : '';
    $noteFull = $voucher->note ? strip_tags($voucher->note) : '';
@endphp
@if(!$isExpired)
<div class="coupon-card tw-flex tw-bg-white tw-rounded-lg tw-shadow-md tw-overflow-visible tw-border tw-h-full tw-min-h-[140px] tw-border-gray-100 tw-relative tw-cursor-pointer tw-z-10">
    <div class="coupon-left tw-w-2/5 xl:tw-w-1/3 tw-bg-[#f97e2b] tw-flex tw-flex-col tw-items-center tw-justify-center tw-text-white tw-p-2 tw-text-center tw-border-r-2 tw-border-dashed tw-border-white tw-rounded-s-lg tw-relative after:tw-absolute after:tw-w-10 after:tw-h-10 after:tw-rounded-full after:tw-bg-white after:tw-top-1/2 after:-tw-translate-y-1/2 after:-tw-left-5">
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
                    @if($expiredAt === null)
                        <span class="tw-bg-gray-400 tw-text-white tw-font-semibold tw-px-2 tw-py-1 tw-rounded-lg tw-text-xs tw-inline-flex tw-items-center tw-gap-1 tw-border tw-border-gray-200">
                            <i class="fa fa-exclamation-circle"></i>
                            {{ __('plugins/voucher::voucher.public.no_expiry') }}
                        </span>
                    @elseif($showCountdown)
                        @if($minutesLeft < 60)
                            <span class="tw-bg-red-500 tw-text-white tw-font-semibold tw-px-2 tw-py-1 tw-rounded-lg tw-text-xs tw-inline-flex tw-items-center tw-gap-1 tw-border tw-border-gray-200">
                                <i class="fa fa-clock"></i>
                                {{ __('plugins/voucher::voucher.public.minutes_left', ['minutes' => $minutesLeftSafe]) }}
                            </span>
                        @elseif($hoursLeft < 24)
                            <span class="tw-bg-red-500 tw-text-white tw-font-semibold tw-px-2 tw-py-1 tw-rounded-lg tw-text-xs tw-inline-flex tw-items-center tw-gap-1 tw-border tw-border-gray-200">
                                <i class="fa fa-clock"></i>
                                {{ __('plugins/voucher::voucher.public.hours_left', ['hours' => $hoursLeftSafe]) }}
                            </span>
                        @else
                            <span class="tw-bg-red-500 tw-text-white tw-font-semibold tw-px-2 tw-py-1 tw-rounded-lg tw-text-xs tw-inline-flex tw-items-center tw-gap-1 tw-border tw-border-gray-200">
                                <i class="fa fa-clock"></i>
                                {{ __('plugins/voucher::voucher.public.days_left', ['days' => $daysLeftSafe]) }}
                            </span>
                        @endif
                    @else
                        <span>
                            <i class="fa fa-clock"></i>
                            {{ __('plugins/voucher::voucher.public.expiry_short') }} {{ $expiredDate }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="tw-w-3/5 xl:tw-w-2/3 tw-rounded-e-lg tw-p-2 tw-flex tw-flex-col tw-justify-between tw-bg-white tw-relative after:tw-absolute after:tw-w-10 after:tw-h-10 after:tw-rounded-full after:tw-bg-white after:-tw-translate-y-1/2 after:tw-top-1/2 after:-tw-right-5">
        <div class="tw-flex tw-flex-col tw-justify-between tw-h-full">
            <div>
                <div class="tw-flex tw-items-center tw-text-xs tw-leading-5">
                    <div class="tw-text-xs tw-font-semibold">
                        {{ __('plugins/voucher::voucher.public.discount_label') }}
                    </div>

                    <div class="tw-text-lg tw-leading-[28px] md:tw-text-[24px] md:tw-leading-[32px] tw-ml-1 tw-text-[#f97e2b]">
                        <span class="tw-font-bold">{{ $discountText }}</span>
                    </div>
                </div>

                <div class="tw-text-xs tw-leading-4 tw-mb-1">
                    <span class="tw-text-xs">{{ __('plugins/voucher::voucher.public.min_order_short') }}</span>
                    <span class="tw-font-semibold">{{ $minOrder }}</span>
                </div>

                <div class="tw-text-xs tw-leading-4 tw-font-medium tw-italic tw-text-gray-500">
                    <span class="tw-text-[#f97e2b] tw-font-medium">{{ __('plugins/voucher::voucher.public.note_label') }}</span> {{ $noteShort }}
                    <span class="tw-text-black tw-font-normal tw-text-[11px] tw-leading-[16px]">{{ __('plugins/voucher::voucher.public.view_detail') }}</span>
                </div>
            </div>

            <div>
                <div class="tw-flex tw-w-full tw-items-center tw-justify-between">
                    <a href="{{ $voucher->apply_url ?: '###' }}" class="tw-text-xs tw-italic tw-underline hover:tw-underline tw-text-[#08bce0]" target="_blank" rel="nofollow">{{ __('plugins/voucher::voucher.public.apply_list') }}</a>

                    <a href="{{ $voucher->banner_url ?: '###' }}" class="tw-text-xs tw-font-medium tw-px-5 tw-py-1.5 tw-text-white tw-bg-[#d96a09] tw-rounded-lg w-ml-1" target="_blank" rel="nofollow">{{ __('plugins/voucher::voucher.public.to_banner') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="coupon-detail tw-absolute tw-shadow-md tw-rounded-lg tw-top-0 tw-left-0 tw-bg-white tw-w-full tw-p-4 tw-hidden tw-z-50">
        <div class="tw-text-[#f97e2b] tw-font-medium tw-text-3xl">
            {{ __('plugins/voucher::voucher.public.discount_prefix') }} {{ $discountText }}
        </div>

        @if($maxDiscount)
        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">{{ __('plugins/voucher::voucher.public.max_label') }}</span>
            <span class="tw-font-semibold">{{ $maxDiscount }}</span>
        </div>
        @endif

        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">{{ __('plugins/voucher::voucher.public.min_order_short') }}</span>
            <span class="tw-font-semibold">{{ $minOrder }}</span>
        </div>

        <div class="tw-text-sm tw-leading-4 tw-mb-1.5">
            <span class="tw-text-sm">{{ __('plugins/voucher::voucher.public.category_label') }}</span>
            <span class="tw-font-semibold">{{ $categoryLabel }}</span>
        </div>

        <div class="tw-text-sm tw-leading-4 tw-font-medium tw-text-gray-500">
            <p class="tw-text-sm tw-text-[#f97e2b] tw-font-medium">{{ __('plugins/voucher::voucher.public.note_label') }}</p>
            <p class="tw-text-sm tw-text-black tw-font-medium">{{ $noteFull }}</p>
        </div>

        <div class="tw-flex tw-w-full tw-items-center tw-justify-between tw-mt-3">
            <a href="{{ $voucher->apply_url ?: '###' }}" class="tw-text-sm tw-italic tw-underline tw-text-[#08bce0]" target="_blank" rel="nofollow">{{ __('plugins/voucher::voucher.public.apply_list') }}</a>

            <a href="{{ $voucher->banner_url ?: '###' }}" class="tw-text-sm tw-font-medium tw-px-5 tw-py-1.5 tw-text-white tw-bg-[#d96a09] tw-rounded w-ml-1" target="_blank" rel="nofollow">{{ __('plugins/voucher::voucher.public.to_banner') }}</a>
        </div>
    </div>
</div>
@endif
@endforeach
@endif
