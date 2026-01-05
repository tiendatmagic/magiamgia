@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.service-layout.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Service layout') }}
                </x-core::card.title>

                <x-core::card.actions>
                    <x-core::button type="submit" color="primary">
                        {{ trans('packages/theme::theme.save_changes') }}
                    </x-core::button>
                </x-core::card.actions>
            </x-core::card.header>

            <x-core::card.body>
                @php
                    $serviceLayout = theme_option('service_layout', 'default');
                    $serviceDetailLayout = theme_option('service_detail_layout', 'default');

                    $serviceGridCols = (int) theme_option('service_grid_cols', 2);
                    $serviceGridColsSm = (int) theme_option('service_grid_cols_sm', 2);
                    $serviceGridColsMd = (int) theme_option('service_grid_cols_md', 3);
                    $serviceGridColsLg = (int) theme_option('service_grid_cols_lg', 4);
                    $serviceGridColsXl = (int) theme_option('service_grid_cols_xl', 4);

                    $serviceGridCols = max(1, min(6, $serviceGridCols));
                    $serviceGridColsSm = max(1, min(6, $serviceGridColsSm));
                    $serviceGridColsMd = max(1, min(6, $serviceGridColsMd));
                    $serviceGridColsLg = max(1, min(6, $serviceGridColsLg));
                    $serviceGridColsXl = max(1, min(6, $serviceGridColsXl));

                    if ($serviceLayout === 'no-sidebar') {
                        $serviceLayout = 'default-no-sidebar';
                    }

                    if ($serviceDetailLayout === 'no-sidebar') {
                        $serviceDetailLayout = 'default-no-sidebar';
                    }
                @endphp

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="service_layout" :label="__('Service page layout')" />
                            <select class="form-select" name="service_layout" id="service_layout">
                                <option value="default" @selected($serviceLayout === 'default')>{{ __('With sidebar') }}</option>
                                <option value="default-no-sidebar" @selected($serviceLayout === 'default-no-sidebar')>{{ __('No sidebar') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="service_detail_layout" :label="__('Service detail layout')" />
                            <select class="form-select" name="service_detail_layout" id="service_detail_layout">
                                <option value="default" @selected($serviceDetailLayout === 'default')>{{ __('With sidebar') }}</option>
                                <option value="default-no-sidebar" @selected($serviceDetailLayout === 'default-no-sidebar')>{{ __('No sidebar') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-3">{{ __('Service grid columns') }}</h4>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="service_grid_cols" :label="__('Columns (mobile)')" />
                            <select class="form-select" name="service_grid_cols" id="service_grid_cols">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($serviceGridCols === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="service_grid_cols_sm" :label="__('Columns (sm)')" />
                            <select class="form-select" name="service_grid_cols_sm" id="service_grid_cols_sm">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($serviceGridColsSm === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="service_grid_cols_md" :label="__('Columns (md)')" />
                            <select class="form-select" name="service_grid_cols_md" id="service_grid_cols_md">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($serviceGridColsMd === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="service_grid_cols_lg" :label="__('Columns (lg)')" />
                            <select class="form-select" name="service_grid_cols_lg" id="service_grid_cols_lg">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($serviceGridColsLg === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="service_grid_cols_xl" :label="__('Columns (xl)')" />
                            <select class="form-select" name="service_grid_cols_xl" id="service_grid_cols_xl">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($serviceGridColsXl === $i)>{{ $i }}</option>
                                @endfor
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
