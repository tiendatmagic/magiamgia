<div class="voucher-accordion-field" data-value='@json($value ?: [])'>
    <input type="hidden" name="{{ $name ?? 'accordions' }}" value="" class="voucher-accordion-json" />

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="text-muted">
            {{ __('Nhấn nút bên phải để thêm accordion item mới') }}</div>
        <button type="button" class="btn btn-sm btn-primary voucher-accordion-add">
            <i class="fa fa-plus"></i> {{ __('Thêm Item') }}
        </button>
    </div>

    <div class="voucher-accordion-items">
        <div class="alert alert-info voucher-accordion-empty-state" style="display: none;">
            <i class="fa fa-info-circle"></i> {{ __('Chưa có accordion item nào. Nhấn nút "Thêm Item" để bắt đầu.') }}
        </div>
    </div>
</div>
