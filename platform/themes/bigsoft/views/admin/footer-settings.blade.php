@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.footer.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Footer') }}
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
                        <div class="mb-3">
                            <x-core::form.label for="footer-image" :label="__('Footer image')" />
                            {!! Form::mediaImage('footer_image', theme_option('footer_image')) !!}
                        </div>

                        <x-core::form.textarea
                            name="footer_description"
                            :label="__('Footer description')"
                            :value="theme_option('footer_description')"
                            rows="6"
                        />

                        <x-core::form.text-input
                            name="text_footer_social"
                            :label="__('Line displaying social media buttons')"
                            :value="theme_option('text_footer_social')"
                        />
                    </div>

                    <div class="col-md-6">
                        <x-core::form.textarea
                            name="copyright"
                            :label="__('Copyright')"
                            :value="theme_option('copyright')"
                            rows="3"
                            :helper-text="__('Copyright on footer of site. Using %Y to display current year.')"
                        />

                        <x-core::form.text-input
                            name="contact_phone"
                            :label="__('Phone')"
                            :value="theme_option('contact_phone')"
                        />

                        <x-core::form.text-input
                            name="contact_email"
                            :label="__('Email')"
                            :value="theme_option('contact_email')"
                        />

                        <x-core::form.text-input
                            name="working_hours"
                            :label="__('Working hours')"
                            :value="theme_option('working_hours')"
                        />

                        <x-core::form.text-input
                            name="website"
                            :label="__('Website')"
                            :value="theme_option('website')"
                        />

                        <x-core::form.text-input
                            name="name_address"
                            :label="__('Name address')"
                            :value="theme_option('name_address')"
                        />

                        <x-core::form.text-input
                            name="address"
                            :label="__('Address')"
                            :value="theme_option('address')"
                        />

                        <x-core::form.text-input
                            name="name_address2"
                            :label="__('Name address 2')"
                            :value="theme_option('name_address2')"
                        />

                        <x-core::form.text-input
                            name="address2"
                            :label="__('Address 2')"
                            :value="theme_option('address2')"
                        />

                        <div class="mb-3">
                            <x-core::form.label for="footer_background_color_from" :label="__('Footer background color (from)')" />
                            <input
                                type="color"
                                class="form-control form-control-color"
                                name="footer_background_color_from"
                                value="{{ theme_option('footer_background_color_from') ?: '#0086cd' }}"
                            >
                        </div>

                        <div class="mb-3">
                            <x-core::form.label for="footer_background_color_to" :label="__('Footer background color (to)')" />
                            <input
                                type="color"
                                class="form-control form-control-color"
                                name="footer_background_color_to"
                                value="{{ theme_option('footer_background_color_to') ?: '#00ecbc' }}"
                            >
                        </div>

                        <div class="mb-3">
                            <x-core::form.label for="footer_copyright_alignment" :label="__('Copyright alignment')" />
                            <select class="form-select" name="footer_copyright_alignment">
                                @php($align = theme_option('footer_copyright_alignment') ?: 'center')
                                <option value="left" @selected($align === 'left')>{{ __('Left') }}</option>
                                <option value="center" @selected($align === 'center')>{{ __('Center') }}</option>
                                <option value="right" @selected($align === 'right')>{{ __('Right') }}</option>
                            </select>
                        </div>
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
