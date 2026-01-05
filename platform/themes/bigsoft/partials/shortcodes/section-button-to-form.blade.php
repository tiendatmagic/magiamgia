@php
    $link = $shortcode->link ?? '#detailFormContact';
    $button_text = $shortcode->button_text ?? 'ĐẶT DỊCH VỤ';
@endphp

<div id="btndetailFormContact" class="py-2 text-center">
    <a href="{{ $link }}">
        <button class="btn btn-primary" type="button">
            {{ $button_text }}
        </button>
    </a>
</div>