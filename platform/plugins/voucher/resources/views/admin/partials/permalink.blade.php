@php
    Assets::addScriptsDirectly('vendor/core/packages/slug/js/slug.js')->addStylesDirectly('vendor/core/packages/slug/css/slug.css');
    $prefix = '';
    $value = $value ?: old('slug');
    $previewURL = url($prefix . '/' . $value);
@endphp

<div
    class="slug-field-wrapper"
    data-field-name="{{ $slugFieldName ?? 'name' }}"
>
    <x-core::form.text-input
        :label="trans('core/base::forms.permalink')"
        :required="true"
        name="slug"
        :group-flat="true"
        class="ps-0"
        :value="$value"
    >
        <x-slot:prepend>
            <span class="input-group-text">
                {{ url($prefix) }}/
            </span>
        </x-slot:prepend>

        <x-slot:append>
            <span class="input-group-text slug-actions">
                <a
                    href="#"
                    @class(['link-secondary', 'd-none' => ! $value])
                    data-bs-toggle="tooltip"
                    aria-label="{{ trans('packages/slug::slug.generate_url') }}"
                    data-bs-original-title="{{ trans('packages/slug::slug.generate_url') }}"
                    data-bb-toggle="generate-slug"
                >
                    <x-core::icon name="ti ti-wand" />
                </a>
            </span>
        </x-slot:append>

        <x-slot:helperText>
            Xem trước: <a href="{{ $previewURL }}" target="_blank">{{ $previewURL }}</a>
        </x-slot:helperText>
    </x-core::form.text-input>

    <input class="slug-current" name="slug" type="hidden" value="{{ $value }}">
    <div class="slug-data" data-url="{{ route('slug.create') }}" data-view="{{ url($prefix) }}/" data-id="{{ $model->id ?? '' }}"></div>
    @if($model && $model->slugable)
        <input name="slug_id" type="hidden" value="{{ $model->slugable->id }}">
    @endif
    <input name="is_slug_editable" type="hidden" value="1">
</div>
