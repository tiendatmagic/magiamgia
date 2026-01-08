@php
    /** @var \Illuminate\Support\Collection|array $vouchers */
@endphp

@foreach($vouchers as $voucher)
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="border rounded p-3 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-semibold">
                        @if($voucher->discount_type === 'percent')
                            Giảm {{ rtrim(rtrim(number_format((float)$voucher->discount_value, 2, '.', ''), '0'), '.') }}%
                        @else
                            Giảm {{ number_format((float)$voucher->discount_value, 0, '.', ',') }}đ
                        @endif
                    </div>
                    @if($voucher->code)
                        <div class="text-muted">Mã: <strong>{{ $voucher->code }}</strong></div>
                    @endif
                    @if($voucher->note)
                        <div class="small text-muted">{!! clean($voucher->note) !!}</div>
                    @endif
                </div>
                @if($voucher->banner_url)
                    <a href="{{ $voucher->apply_url ?: $voucher->banner_url }}" target="_blank" rel="nofollow">
                        <img src="{{ $voucher->banner_url }}" alt="" style="width:48px;height:48px;object-fit:cover" />
                    </a>
                @endif
            </div>

            <div class="mt-2 d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    @if($voucher->expired_at)
                        HSD: {{ $voucher->expired_at->format('d/m/Y') }}
                    @endif
                </div>
                @if($voucher->apply_url)
                    <a class="btn btn-sm btn-success" href="{{ $voucher->apply_url }}" target="_blank" rel="nofollow">Áp dụng</a>
                @endif
            </div>
        </div>
    </div>
@endforeach
