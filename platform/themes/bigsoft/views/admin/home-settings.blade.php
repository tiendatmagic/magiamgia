@extends(BaseHelper::getAdminMasterLayoutTemplate())

@php
    Assets::addScriptsDirectly(config('core.base.general.editor.ckeditor.js'))
        ->addScriptsDirectly('vendor/core/core/base/js/editor.js');

    if (BaseHelper::getRichEditor() === 'ckeditor' && App::getLocale() !== 'en') {
        Assets::addScriptsDirectly(sprintf('https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/translations/%s.js', App::getLocale()));
    }
@endphp

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

                                            <a data-bb-toggle="image-picker-choose" data-target="popup" data-result="sliders-{{ $index }}-image" data-action="select-image" data-allow-thumb="1" href="#">
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

                                            <a data-bb-toggle="image-picker-choose" data-target="popup" data-result="sliders-${newIndex}-image" data-action="select-image" data-allow-thumb="1" href="#">
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






                <div class="col-md-12">
                    <hr class="my-4">
                    <h5 class="mb-3">{{ __('Hot Vouchers Section') }}</h5>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <x-core::form.label for="hot_vouchers_title" :label="__('Hot Vouchers Section Title')" />
                        <input
                            type="text"
                            class="form-control"
                            name="hot_vouchers_title"
                            id="hot_vouchers_title"
                            value="{{ $hotVouchersTitle }}"
                            placeholder="{{ __('Enter hot vouchers section title') }}"
                        >
                        <small class="text-muted d-block mt-1">{{ __('Title displayed above hot vouchers list') }}</small>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <x-core::form.label for="hot_vouchers_description" :label="__('Hot Vouchers Description')" />
                        <textarea
                            class="form-control"
                            name="hot_vouchers_description"
                            id="hot_vouchers_description"
                            rows="5"
                            placeholder="{{ __('Enter description') }}"
                        >{{ $hotVouchersDescription }}</textarea>
                        <small class="text-muted d-block mt-1">{{ __('Description shown above hot vouchers on homepage') }}</small>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr class="my-4">
                </div>

                <div class="col-md-12">
                    <div class="card meta-boxes mb-3">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fa fa-list"></i> {{ __('FAQ Section') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <x-core::form.label for="home_faqs_title" :label="__('FAQ Section Title')" />
                                <input
                                    type="text"
                                    class="form-control"
                                    name="home_faqs_title"
                                    id="home_faqs_title"
                                    value="{{ $homeFaqsTitle ?? '' }}"
                                    placeholder="{{ __('Enter FAQ section title') }}"
                                >
                                <small class="text-muted d-block mt-1">{{ __('Title displayed above FAQ list') }}</small>
                            </div>

                            <div class="mb-4">
                                <x-core::form.label for="home_faqs_description" :label="__('FAQ Description')" />
                                <textarea
                                    class="form-control"
                                    name="home_faqs_description"
                                    id="home_faqs_description"
                                    rows="4"
                                    placeholder="{{ __('Enter description') }}"
                                >{{ $homeFaqsDescription ?? '' }}</textarea>
                                <small class="text-muted d-block mt-1">{{ __('Description shown above FAQ on homepage') }}</small>
                            </div>

                            <hr class="my-3">
                            <label class="fw-bold mb-3">{{ __('FAQ Items') }}</label>

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="text-muted">
                                    {{ __('Click the button on the right to add a new FAQ item') }}
                                </div>
                                <button type="button" class="btn btn-sm btn-primary faq-accordion-add">
                                    <i class="fa fa-plus"></i> {{ __('Add Item') }}
                                </button>
                            </div>

                            <div class="faq-accordion-items">
                                <div class="alert alert-info faq-accordion-empty-state" style="display: none;">
                                    <i class="fa fa-info-circle"></i> {{ __('No FAQ items yet. Click "Add Item" to start.') }}
                                </div>

                                @forelse($homeFaqs as $index => $faq)
                                <div class="card faq-accordion-item mb-2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="fw-bold text-primary faq-accordion-title-toggle" style="cursor: pointer; user-select: none; flex: 1;" data-bs-toggle="collapse" data-bs-target="#faq_item_content_{{ $index }}" aria-expanded="false">
                                                <i class="fa fa-chevron-right faq-accordion-toggle" style="width: 16px; display: inline-block; transition: transform 0.2s;"></i>
                                                <span class="faq-accordion-title-text">{{ $faq['question'] ?? 'FAQ Item' }}</span>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-secondary faq-accordion-move-up" title="{{ __('Move up') }}"><i class="fa fa-arrow-up mx-auto"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary faq-accordion-move-down" title="{{ __('Move down') }}"><i class="fa fa-arrow-down mx-auto"></i></button>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger faq-accordion-remove"><i class="fa fa-trash"></i> {{ __('Remove') }}</button>
                                            </div>
                                        </div>
                                        <div id="faq_item_content_{{ $index }}" class="collapse" data-index="{{ $index }}">
                                            <div class="border-top pt-3 mt-3">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">{{ __('Question') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control faq-accordion-title" name="home_faqs[{{ $index }}][question]" placeholder="{{ __('Enter FAQ question...') }}" value="{{ $faq['question'] ?? '' }}">
                                                </div>
                                                <div>
                                                    <label class="form-label fw-semibold">{{ __('Answer') }} <span class="text-danger">*</span></label>
                                                    <textarea class="form-control faq-accordion-content" id="faq_answer_{{ $index }}" name="home_faqs[{{ $index }}][answer]" rows="5" placeholder="{{ __('Enter FAQ answer...') }}">{{ $faq['answer'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info faq-accordion-empty-state">
                                    <i class="fa fa-info-circle"></i> {{ __('No FAQ items yet. Click "Add Item" to start.') }}
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const container = document.querySelector('.faq-accordion-items');
                        const addBtn = document.querySelector('.faq-accordion-add');
                        const emptyState = document.querySelector('.faq-accordion-empty-state');

                        function updateEmptyState() {
                            const items = container.querySelectorAll('.faq-accordion-item').length;
                            if (emptyState) {
                                emptyState.style.display = items === 0 ? 'block' : 'none';
                            }
                        }

                        function initEditorForItem(item) {
                            const contentTextarea = item.querySelector('.faq-accordion-content');
                            if (!contentTextarea) return;

                            const textareaId = contentTextarea.id;
                            if (!textareaId) return;

                            // Initialize CKEditor with retry logic
                            let retryCount = 0;
                            const maxRetries = 10;
                            const initEditor = function() {
                                if (window.EDITOR && window.EDITOR.initCkEditor) {
                                    window.EDITOR.initCkEditor(textareaId, {});
                                } else if (retryCount < maxRetries) {
                                    retryCount++;
                                    setTimeout(initEditor, 300);
                                }
                            };
                            initEditor();
                        }

                        function attachItemHandlers(item) {
                            const titleInput = item.querySelector('.faq-accordion-title');
                            const titleToggle = item.querySelector('.faq-accordion-title-toggle');
                            const titleText = item.querySelector('.faq-accordion-title-text');
                            const removeBtn = item.querySelector('.faq-accordion-remove');
                            const moveUpBtn = item.querySelector('.faq-accordion-move-up');
                            const moveDownBtn = item.querySelector('.faq-accordion-move-down');
                            const collapseEl = item.querySelector('[id^="faq_item_content_"]');
                            const contentTextarea = item.querySelector('.faq-accordion-content');

                            // Initialize CKEditor for answer field
                            initEditorForItem(item);

                            // Update title text when input changes
                            if (titleInput && titleText) {
                                titleInput.addEventListener('input', function() {
                                    titleText.textContent = this.value || 'FAQ Item';
                                });
                            }

                            // Toggle collapse icon
                            if (collapseEl) {
                                // Ensure editor initializes only after the panel is visible
                                collapseEl.addEventListener('shown.bs.collapse', function() {
                                    initEditorForItem(item);
                                    const icon = item.querySelector('.faq-accordion-toggle');
                                    if (icon) {
                                        icon.style.transform = 'rotate(90deg)';
                                    }
                                });

                                collapseEl.addEventListener('show.bs.collapse', function() {
                                    const icon = item.querySelector('.faq-accordion-toggle');
                                    if (icon) {
                                        icon.style.transform = 'rotate(90deg)';
                                    }
                                });

                                collapseEl.addEventListener('hide.bs.collapse', function() {
                                    const icon = item.querySelector('.faq-accordion-toggle');
                                    if (icon) {
                                        icon.style.transform = 'rotate(0deg)';
                                    }
                                });
                            }

                            // Remove button
                            if (removeBtn) {
                                removeBtn.addEventListener('click', function() {
                                    // Destroy CKEditor instance before removing
                                    if (contentTextarea && window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[contentTextarea.id]) {
                                        window.EDITOR.CKEDITOR[contentTextarea.id].destroy();
                                        delete window.EDITOR.CKEDITOR[contentTextarea.id];
                                    }
                                    item.remove();
                                    updateEmptyState();
                                });
                            }

                            // Move up button
                            if (moveUpBtn) {
                                moveUpBtn.addEventListener('click', function() {
                                    const prev = item.previousElementSibling;
                                    if (prev && prev.classList.contains('faq-accordion-item')) {
                                        item.parentNode.insertBefore(item, prev);
                                        updateItemIndices();
                                    }
                                });
                            }

                            // Move down button
                            if (moveDownBtn) {
                                moveDownBtn.addEventListener('click', function() {
                                    const next = item.nextElementSibling;
                                    if (next && next.classList.contains('faq-accordion-item')) {
                                        item.parentNode.insertBefore(next, item);
                                        updateItemIndices();
                                    }
                                });
                            }
                        }

                        function updateItemIndices() {
                            const items = container.querySelectorAll('.faq-accordion-item');
                            items.forEach((item, index) => {
                                const questionInput = item.querySelector('.faq-accordion-title');
                                const answerInput = item.querySelector('.faq-accordion-content');
                                const collapseEl = item.querySelector('[id^="faq_item_content_"]');

                                if (questionInput) {
                                    questionInput.name = `home_faqs[${index}][question]`;
                                }
                                if (answerInput) {
                                    const oldId = answerInput.id;
                                    const newId = `faq_answer_${index}`;
                                    answerInput.id = newId;
                                    answerInput.name = `home_faqs[${index}][answer]`;

                                    // Update CKEditor instance reference if exists
                                    if (window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[oldId]) {
                                        window.EDITOR.CKEDITOR[newId] = window.EDITOR.CKEDITOR[oldId];
                                        delete window.EDITOR.CKEDITOR[oldId];
                                    }
                                }
                                if (collapseEl) {
                                    const newId = `faq_item_content_${index}`;
                                    collapseEl.id = newId;
                                    collapseEl.dataset.index = index;
                                    const toggle = item.querySelector('.faq-accordion-title-toggle');
                                    if (toggle) {
                                        toggle.setAttribute('data-bs-target', `#${newId}`);
                                    }
                                }
                            });
                        }

                        // Add new FAQ
                        if (addBtn) {
                            addBtn.addEventListener('click', function() {
                                const items = container.querySelectorAll('.faq-accordion-item');
                                const newIndex = items.length;
                                const timestamp = Date.now();
                                const randomStr = Math.random().toString(36).substring(2, 10);
                                const newId = `faq_item_content_${timestamp}_${randomStr}`;
                                const answerId = `faq_answer_${timestamp}_${randomStr}`;

                                const newItem = document.createElement('div');
                                newItem.className = 'card mb-2 faq-accordion-item';
                                newItem.innerHTML = `
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="fw-bold text-primary faq-accordion-title-toggle" style="cursor: pointer; user-select: none; flex: 1;" data-bs-toggle="collapse" data-bs-target="#${newId}" aria-expanded="false">
                                                <i class="fa fa-chevron-right faq-accordion-toggle" style="width: 16px; display: inline-block; transition: transform 0.2s;"></i>
                                                <span class="faq-accordion-title-text">FAQ Item</span>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-secondary faq-accordion-move-up" title="{{ __('Move up') }}"><i class="fa fa-arrow-up mx-auto"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary faq-accordion-move-down" title="{{ __('Move down') }}"><i class="fa fa-arrow-down mx-auto"></i></button>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger faq-accordion-remove"><i class="fa fa-trash"></i> {{ __('Remove') }}</button>
                                            </div>
                                        </div>
                                        <div id="${newId}" class="collapse show" data-index="${newIndex}">
                                            <div class="border-top pt-3 mt-3">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">{{ __('Question') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control faq-accordion-title" name="home_faqs[${newIndex}][question]" placeholder="{{ __('Enter FAQ question...') }}" value="">
                                                </div>
                                                <div>
                                                    <label class="form-label fw-semibold">{{ __('Answer') }} <span class="text-danger">*</span></label>
                                                    <textarea class="form-control faq-accordion-content" id="${answerId}" name="home_faqs[${newIndex}][answer]" rows="5" placeholder="{{ __('Enter FAQ answer...') }}"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                container.appendChild(newItem);
                                attachItemHandlers(newItem);
                                updateEmptyState();

                                // Focus on the question input
                                newItem.querySelector('.faq-accordion-title').focus();
                            });
                        }

                        // Attach handlers to existing items
                        document.querySelectorAll('.faq-accordion-item').forEach(item => {
                            attachItemHandlers(item);

                            // Initialize editor for any item that is already expanded on load
                            const expanded = item.querySelector('.collapse.show');
                            if (expanded) {
                                initEditorForItem(item);
                            }
                        });

                        updateEmptyState();
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
