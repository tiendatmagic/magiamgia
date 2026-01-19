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
        <x-core::form :url="route('theme.footer.update')" method="post" class="theme-option">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Chân trang') }}
                </x-core::card.title>

                <x-core::card.actions>
                    <x-core::button type="submit" color="primary">
                        {{ trans('packages/theme::theme.save_changes') }}
                    </x-core::button>
                </x-core::card.actions>
            </x-core::card.header>

            <x-core::card.body>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">{{ __('Nội dung chân trang') }}</h5>

                        <x-core::form.text-input
                            name="site_title"
                            :label="__('Tên website')"
                            :value="theme_option('site_title')"
                        />

                        <x-core::form.textarea
                            name="footer_description"
                            :label="__('Mô tả chân trang')"
                            :value="theme_option('footer_description')"
                            rows="6"
                        />

                        <x-core::form.textarea
                            name="copyright"
                            :label="__('Copyright')"
                            :value="theme_option('copyright')"
                            rows="3"
                            :helper-text="__('Hiển thị dưới chân trang. Dùng %Y để hiển thị năm hiện tại.')"
                        />

                        <h5 class="mt-4 mb-3">{{ __('Màu nền & căn lề') }}</h5>

                        <div class="mb-3">
                            <x-core::form.label for="footer_background_color_from" :label="__('Màu nền chân trang (từ)')" />
                            <input
                                type="color"
                                class="form-control form-control-color"
                                name="footer_background_color_from"
                                value="{{ theme_option('footer_background_color_from') ?: '#0086cd' }}"
                            >
                        </div>

                        <div class="mb-3">
                            <x-core::form.label for="footer_background_color_to" :label="__('Màu nền chân trang (đến)')" />
                            <input
                                type="color"
                                class="form-control form-control-color"
                                name="footer_background_color_to"
                                value="{{ theme_option('footer_background_color_to') ?: '#00ecbc' }}"
                            >
                        </div>

                        <div class="mb-3">
                            <x-core::form.label for="footer_copyright_alignment" :label="__('Căn lề copyright')" />
                            <select class="form-select" name="footer_copyright_alignment">
                                @php($align = theme_option('footer_copyright_alignment') ?: 'center')
                                <option value="left" @selected($align === 'left')>{{ __('Trái') }}</option>
                                <option value="center" @selected($align === 'center')>{{ __('Giữa') }}</option>
                                <option value="right" @selected($align === 'right')>{{ __('Phải') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">{{ __('Tổng đài hỗ trợ') }}</h5>

                        <x-core::form.text-input
                            name="footer_support_title"
                            :label="__('Tiêu đề khối (VD: Tổng đài hỗ trợ)')"
                            :value="theme_option('footer_support_title')"
                        />

                        <x-core::form.textarea
                            name="footer_info_html"
                            :label="__('HTML nội dung khối hỗ trợ')"
                            :value="theme_option('footer_info_html')"
                            rows="8"
                            class="editor-ckeditor wysiwyg-editor"
                            :helper-text="__('Nhập HTML cho toàn bộ thẻ .footer-info. Nếu để trống, hệ thống sẽ dùng từng ô nhập riêng lẻ.')"
                        />

                        <!-- Support fields replaced by `footer_info_html` editor -->

                        <h5 class="tw-font-medium mt-4 mb-3">{{ __('Kết nối với chúng tôi') }}</h5>

                        <x-core::form.text-input
                            name="footer_connect_title"
                            :label="__('Tiêu đề')"
                            :value="theme_option('footer_connect_title')"
                        />

                        <h5 class="mt-4 mb-3">{{ __('Chat Zalo') }}</h5>

                        <x-core::form.text-input
                            name="footer_zalo_label"
                            :label="__('Tên hiển thị (VD: Chat Zalo)')"
                            :value="theme_option('footer_zalo_label')"
                        />

                        <x-core::form.text-input
                            name="zalo_link"
                            :label="__('Liên kết Zalo')"
                            :value="theme_option('zalo_link')"
                        />

                        <div class="mb-3">
                            <x-core::form.label for="footer_zalo_icon" :label="__('Icon Zalo (upload)')" />
                            {!! Form::mediaImage('footer_zalo_icon', theme_option('footer_zalo_icon')) !!}
                        </div>

                        <!-- App promo removed as requested -->

                        <!-- Chứng nhận / Bộ công thương: đã xóa theo yêu cầu (admin) -->

                        <h5 class="mt-4 mb-3">{{ __('Địa chỉ & Email') }}</h5>

                        <x-core::form.text-input
                            name="footer_address_hn_label"
                            :label="__('Nhãn địa chỉ 1')"
                            :value="theme_option('footer_address_hn_label')"
                        />

                        <x-core::form.text-input
                            name="address_hn"
                            :label="__('Địa chỉ Hà Nội')"
                            :value="theme_option('address_hn')"
                        />

                        <x-core::form.text-input
                            name="footer_address_hcm_label"
                            :label="__('Nhãn địa chỉ 2')"
                            :value="theme_option('footer_address_hcm_label')"
                        />

                        <x-core::form.text-input
                            name="address_hcm"
                            :label="__('Địa chỉ TP.HCM')"
                            :value="theme_option('address_hcm')"
                        />

                        <x-core::form.text-input
                            name="contact_email"
                            :label="__('Email')"
                            :value="theme_option('contact_email')"
                        />

                        <!-- Nút liên hệ nổi (floating buttons): các field liên quan đã xóa theo yêu cầu (admin) -->
                    </div>
                </div>
            </x-core::card.body>

            <x-core::card.footer>
                <x-core::button type="submit" color="primary">
                    {{ trans('packages/theme::theme.save_changes') }}
                </x-core::button>
            </x-core::card.footer>
        </x-core::form>
    </x-core::card>
@endsection
