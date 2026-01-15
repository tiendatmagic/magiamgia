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
                                placeholder="Nhà cung cấp nổi bật"
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
                                placeholder="Enter description"
                            >{{ $homeDescription }}</textarea>
                            <small class="text-muted d-block mt-1">{{ __('Description shown on homepage') }}</small>
                        </div>
                    </div>
                </div>
            </x-core::card.body>
        </x-core::form>
    </x-core::card>
@endsection
