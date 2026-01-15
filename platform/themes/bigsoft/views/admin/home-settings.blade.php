@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.home.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Home Page Settings') }}
                </x-core::card.title>

                <x-core::card.actions>
                    <x-core::button type="submit" color="primary">
                        {{ trans('packages/theme::theme.save_changes') }}
                    </x-core::button>
                </x-core::card.actions>
            </x-core::card.header>

            <x-core::card.body>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-core::form.label for="home_title" :label="__('Providers Section Title')" />
                            <input
                                type="text"
                                class="form-control"
                                name="home_title"
                                id="home_title"
                                value="{{ $homeTitle }}"
                                placeholder="{{ __('Enter provider section title') }}"
                            >
                            <small class="text-muted d-block mt-1">{{ __('Title displayed above provider list') }}</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-core::form.label for="home_description" :label="__('Providers Description')" />
                            <textarea
                                class="form-control"
                                name="home_description"
                                id="home_description"
                                rows="5"
                                placeholder="{{ __('Enter description') }}"
                            >{{ $homeDescription }}</textarea>
                            <small class="text-muted d-block mt-1">{{ __('Description shown on homepage') }}</small>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr class="my-4">
                        <h5 class="mb-3">{{ __('Home Page Sliders') }}</h5>
                    </div>

                    <div class="col-md-12">
                        <div id="sliders-container">
                            @forelse($homeSliders as $index => $slider)
                            <div class="slider-item p-3 mb-4 border rounded" data-index="{{ $index }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Slider Image') }}</label>
                                        <div class="image-box image-box-sliders-{{ $index }}" action="select-image">
                                            <input class="image-data" name="home_sliders[{{ $index }}][image]" type="hidden" value="{{ $slider['image'] ?? '' }}">

                                            <div style="width: 150px" class="preview-image-wrapper mb-2">
                                                <div class="preview-image-inner">
                                                    <a data-bb-toggle="image-picker-choose" data-target="popup" class="image-box-actions" data-result="sliders-{{ $index }}-image" data-action="select-image" data-allow-thumb="1" href="#">
                                                        <img class="preview-image" data-default="{{ asset('vendor/core/core/base/images/placeholder.png') }}" src="{{ !empty($slider['image']) ? RvMedia::getImageUrl($slider['image'], '150x150', false, RvMedia::getDefaultImage()) : asset('vendor/core/core/base/images/placeholder.png') }}" alt="Preview image">
                                                        <span class="image-picker-backdrop"></span>
                                                    </a>
                                                    <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0" type="button" data-bb-toggle="image-picker-remove" onclick="removeSliderImage(this)">
                                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M18 6l-12 12"></path>
                                                            <path d="M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <a data-bb-toggle="image-picker-choose" data-target="popup" data-result="sliders-{{ $index }}-image" data-action="select-image" data-allow-thumb="1" href="#" class="btn btn-sm btn-primary">
                                                {{ __('Choose Image') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Slider URL') }}</label>
                                        <input type="url" class="form-control" name="home_sliders[{{ $index }}][url]" value="{{ $slider['url'] ?? '' }}" placeholder="https://example.com">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeSlider(this)">
                                                {{ __('Remove') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-muted">{{ __('No sliders yet') }}</div>
                            @endforelse
                        </div>

                        <button type="button" class="btn btn-sm btn-success mt-3" onclick="addSlider()">
                            + {{ __('Add Slider') }}
                        </button>
                    </div>
                </div>

                <style>
                    .slider-item {
                        background-color: #f8f9fa;
                    }
                    .image-box-actions {
                        display: block;
                        cursor: pointer;
                    }
                    .preview-image-wrapper {
                        position: relative;
                    }
                    .image-picker-remove-button {
                        position: absolute;
                        top: 5px;
                        right: 5px;
                    }
                </style>

                <script>
                    function initImagePicker(element) {
                        const link = element.querySelector('[data-bb-toggle="image-picker-choose"]');
                        if (link && jQuery) {
                            $(link).rvMedia({
                                multiple: false,
                                filter: 'image',
                                view_in: 'all_media',
                                onSelectFiles: (files, $el) => {
                                    let firstImage = _.first(files);
                                    const $imageBox = $el.closest('.image-box');
                                    const allowThumb = $el.data('allow-thumb');
                                    $imageBox.find('.image-data').val(firstImage.url).trigger('change');
                                    $imageBox.find('.preview-image').attr(
                                        'src',
                                        allowThumb && firstImage.thumb ? firstImage.thumb : firstImage.full_url
                                    );
                                    $imageBox.find('[data-bb-toggle="image-picker-remove"]').show();
                                    $imageBox.find('.preview-image').removeClass('default-image');
                                }
                            });
                        }
                    }

                    function addSlider() {
                        const container = document.getElementById('sliders-container');
                        const count = container.querySelectorAll('.slider-item').length;
                        const newIndex = count;

                        const newSlider = `
                            <div class="slider-item p-3 mb-4 border rounded" data-index="${newIndex}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Slider Image') }}</label>
                                        <div class="image-box image-box-sliders-${newIndex}" action="select-image">
                                            <input class="image-data" name="home_sliders[${newIndex}][image]" type="hidden" value="">

                                            <div style="width: 150px" class="preview-image-wrapper mb-2">
                                                <div class="preview-image-inner">
                                                    <a data-bb-toggle="image-picker-choose" data-target="popup" class="image-box-actions" data-result="sliders-${newIndex}-image" data-action="select-image" data-allow-thumb="1" href="#">
                                                        <img class="preview-image" data-default="{{ asset('vendor/core/core/base/images/placeholder.png') }}" src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" alt="Preview image">
                                                        <span class="image-picker-backdrop"></span>
                                                    </a>
                                                    <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0" type="button" data-bb-toggle="image-picker-remove" onclick="removeSliderImage(this)">
                                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M18 6l-12 12"></path>
                                                            <path d="M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <a data-bb-toggle="image-picker-choose" data-target="popup" data-result="sliders-${newIndex}-image" data-action="select-image" data-allow-thumb="1" href="#" class="btn btn-sm btn-primary">
                                                {{ __('Choose Image') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Slider URL') }}</label>
                                        <input type="url" class="form-control" name="home_sliders[${newIndex}][url]" value="" placeholder="https://example.com">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-danger" onclick="removeSlider(this)">
                                                {{ __('Remove') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        container.insertAdjacentHTML('beforeend', newSlider);

                        // Initialize image picker for the new slider
                        const newSliderElement = container.querySelector(`[data-index="${newIndex}"]`);
                        initImagePicker(newSliderElement);
                    }

                    function removeSlider(button) {
                        button.closest('.slider-item').remove();
                    }

                    function removeSliderImage(button) {
                        const imageInput = button.closest('.image-box').querySelector('.image-data');
                        const previewImg = button.closest('.preview-image-inner').querySelector('.preview-image');
                        imageInput.value = '';
                        previewImg.src = imageInput.dataset.default || '{{ asset('vendor/core/core/base/images/placeholder.png') }}';
                    }

                    // Initialize image pickers for existing sliders on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('.slider-item').forEach(sliderItem => {
                            initImagePicker(sliderItem);
                        });
                    });
                </script>

                <div class="row mt-4">
                    <div class="col-md-12 d-flex justify-content-end">
                        <x-core::button type="submit" color="primary">
                            {{ trans('packages/theme::theme.save_changes') }}
                        </x-core::button>
                    </div>
                </div>
            </x-core::card.body>
        </x-core::form>
    </x-core::card>
@endsection
