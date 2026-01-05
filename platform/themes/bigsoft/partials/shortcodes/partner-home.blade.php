<section class="tw-py-[30px] tw-bg-[#f8f9fa] section-partners">
  <div class="container">

    @php
    use Botble\Partners\Models\Partners;

    $partners = collect();

    if (function_exists('is_plugin_active') && is_plugin_active('partners')) {
    $partners = Partners::where('status', 'published')->get();
    }
    @endphp

    <div class="listDetailParner row">
      @foreach ($partners as $partner)
      <div class="listDetailParnerLogo col-6 col-md-2">

        @if (!empty($partner->link))
        <a href="{{ $partner->link }}" target="_blank" rel="nofollow noopener">
          @endif

          <img
            src="{{ RvMedia::getImageUrl($partner->image) }}"
            class="card-img-top"
            alt="{{ $partner->name }}">

          @if (!empty($partner->link))
        </a>
        @endif

      </div>
      @endforeach
    </div>


  </div>
</section>