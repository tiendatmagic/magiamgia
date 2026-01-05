@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.header.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Header') }}
                </x-core::card.title>

                <x-core::card.actions>
                    <x-core::button type="submit" color="primary">
                        {{ trans('packages/theme::theme.save_changes') }}
                    </x-core::button>
                </x-core::card.actions>
            </x-core::card.header>

            <x-core::card.body>
                @php($headerLayout = theme_option('header_layout', 'logo-left'))
                @php($headerBackgroundColor = theme_option('header_background_color') ?: '#ffffff')
                @php($headerSearchStyle = theme_option('header_search_style', 'icon'))

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="header_layout" :label="__('Header layout')" />
                            <select class="form-select" name="header_layout" id="header_layout">
                                <option value="logo-left" @selected($headerLayout === 'logo-left')>{{ __('Logo left, menu right') }}</option>
                                <option value="logo-center" @selected($headerLayout === 'logo-center')>{{ __('Logo center, menu below') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="header_background_color" :label="__('Header background color')" />
                            <input
                                type="color"
                                class="form-control form-control-color"
                                name="header_background_color"
                                id="header_background_color"
                                value="{{ $headerBackgroundColor }}"
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="header_search_style" :label="__('Search style')" />
                            <select class="form-select" name="header_search_style" id="header_search_style">
                                <option value="icon" @selected($headerSearchStyle === 'icon')>{{ __('Search icon') }}</option>
                                <option value="topbar" @selected($headerSearchStyle === 'topbar')>{{ __('Search input (topbar)') }}</option>
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
