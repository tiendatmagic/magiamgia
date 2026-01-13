@php
    $title = $title ?? 'Accordion';
    $name = $name ?? 'accordions';
    $value = $value ?? [];
    $icon = $icon ?? 'fa-list';
@endphp

<div class="card meta-boxes mb-3">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fa {{ $icon }}"></i> {{ $title }}
        </h4>
    </div>
    <div class="card-body">
        @include('plugins/voucher::admin.partials.accordion-field', [
            'name' => $name,
            'value' => $value,
        ])
    </div>
</div>
