@php
    /** @var \Botble\Voucher\Models\Provider $provider */
@endphp

<div class="container">
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3">
            @if($provider->logo)
                <img src="{{ RvMedia::getImageUrl($provider->logo) }}" alt="{{ $provider->name }}" style="width:60px;height:60px;object-fit:contain" />
            @endif
            <div>
                <h1 class="h4 mb-1">{{ $provider->name }}</h1>
                @if($provider->description)
                    <div class="text-muted">{!! clean($provider->description) !!}</div>
                @endif
            </div>
        </div>
        <div class="mt-3 d-flex gap-2 flex-wrap">
            @if($provider->button_1_text && $provider->button_1_url)
                <a class="btn btn-primary" href="{{ $provider->button_1_url }}" target="_blank" rel="nofollow">{{ $provider->button_1_text }}</a>
            @endif
            @if($provider->button_2_text && $provider->button_2_url)
                <a class="btn btn-secondary" href="{{ $provider->button_2_url }}" target="_blank" rel="nofollow">{{ $provider->button_2_text }}</a>
            @endif
        </div>
    </div>

    <div id="voucher-list" class="row" data-provider="{{ optional($provider->slugable)->key }}" data-offset="18">
        @include('plugins/voucher::public.partials.voucher-items', ['vouchers' => $vouchers])
    </div>

    <div class="text-center mt-4">
        <button type="button" class="btn btn-outline-primary" id="voucher-load-more">
            {{ __('Xem thêm') }}
        </button>
    </div>

    @if(is_array($provider->accordions) && count($provider->accordions))
        <hr class="my-5" />
        <div class="accordion" id="providerAccordion">
            @foreach($provider->accordions as $i => $item)
                @php
                    $title = $item['title'] ?? '';
                    $content = $item['content'] ?? '';
                    $collapseId = 'provider-acc-' . $i;
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $collapseId }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
                            {{ $title }}
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $collapseId }}" data-bs-parent="#providerAccordion">
                        <div class="accordion-body">{!! clean($content) !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    (function () {
        const btn = document.getElementById('voucher-load-more');
        const list = document.getElementById('voucher-list');
        if (!btn || !list) return;

        let loading = false;

        btn.addEventListener('click', async function () {
            if (loading) return;
            loading = true;
            btn.disabled = true;

            try {
                const provider = list.getAttribute('data-provider') || '';
                const offset = parseInt(list.getAttribute('data-offset') || '18', 10);

                const url = new URL('{{ route('public.ajax.voucher.load-more') }}', window.location.origin);
                url.searchParams.set('provider', provider);
                url.searchParams.set('offset', String(offset));

                const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                const payload = data.data || data;

                if (payload && payload.html) {
                    const tmp = document.createElement('div');
                    tmp.innerHTML = payload.html;
                    while (tmp.firstChild) {
                        list.appendChild(tmp.firstChild);
                    }

                    list.setAttribute('data-offset', String(payload.nextOffset || (offset + 9)));
                    if (!payload.count || payload.count < 9) {
                        btn.remove();
                    }
                }
            } catch (e) {
                // ignore
            } finally {
                loading = false;
                if (document.body.contains(btn)) {
                    btn.disabled = false;
                }
            }
        });
    })();
</script>
