@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <form method="POST" action="{{ route('robot-txt.settings.update') }}">
            @csrf
            @method('PUT')

            <x-core::form.textarea
                :label="trans('plugins/robot-txt::robot-txt.title')"
                name="content"
                rows="15"
            >
                {{ old('content', $content ?? '') }}
            </x-core::form.textarea>

            <div class="mt-3">
                <x-core::button type="submit" color="primary">{{ trans('core/base::forms.save') }}</x-core::button>
            </div>
        </form>
    </x-core::card>
@endsection
