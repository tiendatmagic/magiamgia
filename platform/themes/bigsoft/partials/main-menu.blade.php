<ul {!! BaseHelper::clean($options) !!}>
    @foreach ($menu_nodes as $key => $row)
        @php
            $url = $row->url;

            if (Str::startsWith($url, url('/'))) {
                $slug = Str::after($url, url('/') . '/');
                $slug = trim($slug, '/');

                $slugModel = \Botble\Slug\Models\Slug::where('key', $slug)
                    ->where('reference_type', \Botble\Page\Models\Page::class)
                    ->first();

                if ($slugModel) {
                    $page = \Botble\Page\Models\Page::find($slugModel->reference_id);
                    if ($page && get_field($page, 'is_service', 0)) {
                        $url = url('/dich-vu/' . $slug);
                    }
                }
            }
        @endphp

        <li class="menu-item @if ($row->has_child) menu-item-has-children @endif {{ $row->css_class }} @if ($row->active) active @endif">
            <a href="{{ $url }}" target="{{ $row->target }}">
                {!! $row->icon_html !!}
                <span class="menu-title">{{ $row->title }}</span>

                @if ($row->has_child) <span class="toggle-icon">
                    {!! BaseHelper::renderIcon('ti ti-chevron-down') !!}
                </span>@endif
            </a>

            @if ($row->has_child)
          {!!
                    Menu::generateMenu([
                        'menu' => $menu,
                        'menu_nodes' => $row->child,
                        'view' => 'main-menu',
                        'options' => ['class' => 'sub-menu'],
                    ])
                !!}
            @endif
        </li>
    @endforeach
</ul>
