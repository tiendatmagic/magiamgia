@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.404.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('404') }}
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
                        <x-core::form.text-input
                            name="404_page_title"
                            :label="__('404 page title')"
                            :value="theme_option('404_page_title')"
                        />

                        <x-core::form.textarea
                            name="404_page_content"
                            :label="__('404 page content')"
                            :value="theme_option('404_page_content')"
                            rows="8"
                        />
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="404_page_image" :label="__('404 page image')" />
                            {!! Form::mediaImage('404_page_image', theme_option('404_page_image')) !!}
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
