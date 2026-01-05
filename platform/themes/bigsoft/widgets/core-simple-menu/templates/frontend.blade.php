<div class="col-lg-2 col-sm-6 lg:tw-mx-16 tw-mb-2 sm:tw-mb-0">
    <aside class="widget widget--transparent widget__footer">
        @if ($config['name'])
            <div class="widget__header">
                <h3 class="widget__title">{{ $config['name'] }}</h3>
            </div>
        @endif
        <div class="widget__content">
            <ul class="list list--light list--fadeIn">
                @foreach ($items as $item)
                    <li>
                        <a
                            href="{{ url((string) $item->url) }}"
                            title="{{ $item->label }}"
                            @if ($item->is_open_new_tab) target="_blank" @endif
                            {!! $item->attributes ? BaseHelper::clean($item->attributes) : null !!}
                        >{{ $item->label }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
