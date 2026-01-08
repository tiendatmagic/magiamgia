<div class="voucher-accordion-field" data-value='@json($value ?: [])'>
    <input type="hidden" name="accordions" value="" class="voucher-accordion-json" />

    <div class="d-flex align-items-center justify-content-between mb-2">
        <div class="text-muted">{{ __('Click + to add more items') }}</div>
        <button type="button" class="btn btn-sm btn-primary voucher-accordion-add">+</button>
    </div>

    <div class="voucher-accordion-items"></div>
</div>
