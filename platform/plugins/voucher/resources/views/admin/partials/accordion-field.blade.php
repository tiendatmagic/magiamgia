@php
    $i18n = [
        'accordion_item' => __('plugins/voucher::voucher.admin.accordion_item'),
        'move_up' => __('plugins/voucher::voucher.admin.move_up'),
        'move_down' => __('plugins/voucher::voucher.admin.move_down'),
        'delete' => __('plugins/voucher::voucher.admin.delete'),
        'title_label' => __('plugins/voucher::voucher.admin.title_label'),
        'title_placeholder' => __('plugins/voucher::voucher.admin.title_placeholder'),
        'content_label' => __('plugins/voucher::voucher.admin.content_label'),
        'content_placeholder' => __('plugins/voucher::voucher.admin.content_placeholder'),
        'tag_placeholder' => __('plugins/voucher::voucher.admin.tag_placeholder'),
        'remove_tag' => __('plugins/voucher::voucher.admin.remove_tag'),
    ];
@endphp

<div class="voucher-accordion-field" data-value='@json($value ?: [])' data-i18n='@json($i18n)'>
    <input type="hidden" name="{{ $name ?? 'accordions' }}" value="" class="voucher-accordion-json" />

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="text-muted">
            {{ __('plugins/voucher::voucher.admin.accordion_hint') }}</div>
        <button type="button" class="btn btn-sm btn-primary voucher-accordion-add">
            <i class="fa fa-plus"></i> {{ __('plugins/voucher::voucher.admin.add_item') }}
        </button>
    </div>

    <div class="voucher-accordion-items">
        <div class="alert alert-info voucher-accordion-empty-state" style="display: none;">
            <i class="fa fa-info-circle"></i> {{ __('plugins/voucher::voucher.admin.empty_state') }}
        </div>
    </div>
</div>
