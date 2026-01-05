</div>

@php
  $footerBackgroundFrom = theme_option('footer_background_color_from') ?: '#0086cd';
  $footerBackgroundTo = theme_option('footer_background_color_to') ?: '#00ecbc';

  $footerCopyrightAlignment = theme_option('footer_copyright_alignment') ?: 'center';
  $footerCopyrightAlignmentClass = match ($footerCopyrightAlignment) {
    'left' => 'tw-text-left',
    'right' => 'tw-text-right',
    default => 'tw-text-center',
  };
@endphp

<footer class="page-footer bg-dark pt-50" style="background-image: radial-gradient(circle, {{ $footerBackgroundFrom }}, {{ $footerBackgroundTo }}); padding-top: 30px; padding-bottom: 30px;">

  <div class="container">
    <div class="row footerTop">
      <div class="col-md-6 tw-mb-2 sm:tw-mb-0">
        <aside class="widget widget--transparent widget__footer widget__about">

          @if (theme_option('footer_image'))
          <a class="logoFooter" href="/">
            <img src="{{ RvMedia::getImageUrl(theme_option('footer_image')) }}" alt="Logo" width="250" height="115" class="tw-mx-auto tw-w-[250px]">
          </a>
          @endif

          @if (theme_option('footer_description'))
          <div class="widget__content">
            <p class="tw-whitespace-pre-wrap tw-mb-2">{{ theme_option('footer_description') }}</p>
          </div>
          @endif
        </aside>
      </div>

      <div class="col-md-6 tw-mb-2 sm:tw-mb-0">
        <aside class="widget widget--transparent widget__footer widget__about">
          <div class="widget__content tw-relative tw-bottom-[3px]">

            @if (theme_option('contact_phone'))
            <p class="tw-pb-[5px] tw-flex tw-items-center tw-justify-left tw-gap-2 tw-text-left">

              <svg class="svg-inline--fa fa-phone-volume tw-text-[#ef5a36] tw-size-5 tw-min-w-5 tw-w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-volume" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"></path>
              </svg>
              <a href="tel:{{ preg_replace('/\D/', '', theme_option('contact_phone')) }}">
                {{ function_exists('format_phone') ? format_phone(theme_option('contact_phone')) : theme_option('contact_phone') }}

              </a>
            </p>
            @endif

            @if ($email = theme_option('contact_email'))
            <p class="tw-pb-[5px] tw-flex tw-items-center tw-justify-left tw-gap-2 tw-text-left">

              <svg class="svg-inline--fa fa-envelope-circle-check tw-text-[#ef5a36] tw-size-5 tw-min-w-5 tw-w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope-circle-check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                <path fill="currentColor" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0l57.4-43c23.9-59.8 79.7-103.3 146.3-109.8l13.9-10.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176 0 384c0 35.3 28.7 64 64 64l296.2 0C335.1 417.6 320 378.5 320 336c0-5.6 .3-11.1 .8-16.6l-26.4 19.8zM640 336a144 144 0 1 0 -288 0 144 144 0 1 0 288 0zm-76.7-43.3c6.2 6.2 6.2 16.4 0 22.6l-72 72c-6.2 6.2-16.4 6.2-22.6 0l-40-40c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L480 353.4l60.7-60.7c6.2-6.2 16.4-6.2 22.6 0z"></path>
              </svg>
              {{ Html::mailto($email) }}
            </p>
            @endif

            @if (theme_option('working_hours'))
            <p class="tw-pb-[5px] tw-flex tw-items-center tw-justify-left tw-gap-2 tw-text-left">
              <svg class="svg-inline--fa fa-clock tw-text-[#ef5a36] tw-size-5 tw-min-w-5 tw-w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"></path>
              </svg>
              {{ (theme_option('working_hours')) ? (theme_option('working_hours')) : null}}
            </p>
            @endif


            @if ($address = theme_option('address'))
            <p class="tw-pb-[5px] tw-text-left">
              <svg class="svg-inline--fa fa-location-dot tw-text-[#ef5a36] tw-size-5 tw-min-w-5 tw-w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                <path fill="currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
              </svg>
              <strong>{{ (theme_option('name_address')) ? (theme_option('name_address') . ':') : null}} </strong>{{ $address }}
            </p>
            @endif

            @if ($address2 = theme_option('address2'))
            <p class="tw-pb-[5px] tw-text-left">
              <svg class="svg-inline--fa fa-location-dot tw-text-[#ef5a36] tw-size-5 tw-min-w-5 tw-w-5" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                <path fill="currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
              </svg>
              <strong>{{ (theme_option('name_address2')) ? (theme_option('name_address2') . ':') : null}} </strong>{{ $address2 }}
            </p>
            @endif

          </div>
        </aside>
      </div>


      {!! dynamic_sidebar('footer_sidebar') !!}

    </div>
  </div>



  <div class="page-footer__bottom">
    <div class="container">
      <div class="row sm:tw-flex-row tw-items-center">
        @if($copyright = theme_option('copyright'))
        <div class="col-md-12 col-sm-12">
          <div class="page-copyright tw-block {{ $footerCopyrightAlignmentClass }}">
            <p>{!! Theme::getSiteCopyright() !!}</p>
          </div>
        </div>
        @endif

        @if ($socialLinks = Theme::getSocialLinks())
        <div class="col-md-12 col-sm-12 text-end">
          <div class="page-footer__social">

            <div class="tw-flex tw-items-center tw-justify-center tw-gap-3 lg:tw-gap-5 tw-my-2.5 tw-flex-wrap">
              @if (theme_option('text_footer_social'))
              <p class="tw-text-base tw-text-white tw-font-bold tw-block tw-text-left tw-w-full sm:tw-w-auto">
                {{ theme_option('text_footer_social') }}
              </p>
              @endif

              <ul class="social social--simple">
                @foreach($socialLinks as $socialLink)
                @continue(! $icon = $socialLink->getIconHtml())
                <li>
                  <a {{ $socialLink->getAttributes() }}>
                    {{ $icon }}
                  </a>
                </li>
                @endforeach
              </ul>
            </div>

          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</footer>
<div id="back2top">
  {!! BaseHelper::renderIcon('ti ti-arrow-narrow-up') !!}
</div>

@php
  $contactButtonPosition = theme_option('contact_button_position') ?: 'right';
  $contactButtonsShowOnMobile = (theme_option('contact_button_show_on_mobile') ?: 'yes') === 'yes';
  $contactButtonsShowOnDesktop = (theme_option('contact_button_show_on_desktop') ?: 'yes') === 'yes';

  $contactButtonsSideClass = $contactButtonPosition === 'left' ? 'tw-left-8' : 'tw-right-8';

  // Visibility rules use Tailwind's `lg` breakpoint as "desktop".
  if (! $contactButtonsShowOnMobile && ! $contactButtonsShowOnDesktop) {
    $contactButtonsVisibilityClass = 'tw-hidden';
  } elseif (! $contactButtonsShowOnMobile && $contactButtonsShowOnDesktop) {
    $contactButtonsVisibilityClass = 'tw-hidden lg:tw-block';
  } elseif ($contactButtonsShowOnMobile && ! $contactButtonsShowOnDesktop) {
    $contactButtonsVisibilityClass = 'lg:tw-hidden';
  } else {
    $contactButtonsVisibilityClass = '';
  }
@endphp

<div class="tw-fixed tw-bottom-8 tw-z-[10000] {{ $contactButtonsSideClass }} {{ $contactButtonsVisibilityClass }}">
  <div class="d-flex flex-column gap-2">
    @if (theme_option('zalo_link'))
    <a href="{{ theme_option('zalo_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-phone tw-w-14 tw-h-14 tw-bg-white tw-shadow-md tw-rounded-full tw-p-[10px]">
        <img src="{{ asset('storage/theme/image/zalo.webp') }}" alt="icon contact zalo" class="tw-w-full tw-h-auto">
      </div>
    </a>
    @endif

    @if (theme_option('whatsapp_link'))
    <a href="{{ theme_option('whatsapp_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-phone tw-w-14 tw-h-14 tw-bg-[#29a71a] tw-shadow-md tw-rounded-full">
        <img src="{{ asset('storage/theme/image/whatsapp.webp') }}" alt="icon contact phone"
          class="tw-w-full tw-h-auto">
      </div>
    </a>
    @endif

    @if (theme_option('phone_link'))
    <a href="tel:{{ preg_replace('/\D/', '', theme_option('phone_link')) }}" class="contact-icon-link" rel="nofollow">
      <div class="icon-phone tw-w-14 tw-h-14 tw-bg-[#fb3d18] tw-shadow-md tw-rounded-full tw-p-[10px]">
        <img src="{{ asset('storage/theme/image/phone_icon.png') }}" alt="icon contact phone"
          class="tw-w-full tw-h-auto">
      </div>
    </a>
    @endif

    @if (theme_option('facebook_link'))
    <a href="{{ theme_option('facebook_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-fb tw-w-14 tw-h-14 tw-bg-[#0482ff] tw-shadow-md tw-rounded-full tw-p-[10px]">
        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="15.8 15.8 25 25" class="tw-text-white">
          <path fill="currentColor"
            d="M32.8 24.7h-3.2v-2.1c0-0.8 0.5-1 0.9-1s2.3 0 2.3 0v-3.5l-3.1 0c-3.5 0-4.3 2.6-4.3 4.3v2.3h-2v3.6h2c0 4.6 0 10.2 0 10.2h4.2c0 0 0-5.6 0-10.2h2.8L32.8 24.7z">
          </path>
        </svg>
      </div>
    </a>
    @endif

    @if (theme_option('facebook_messenger_link'))
    <a href="{{ theme_option('facebook_messenger_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-fb tw-w-14 tw-h-14 tw-bg-[#0482ff] tw-shadow-md tw-rounded-full tw-p-[10px] tw-flex tw-items-center tw-justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" class="tw-text-white" fill="currentColor">
          <path d="M12 2C6.477 2 2 6.145 2 11.254c0 2.91 1.452 5.51 3.726 7.222V22l3.262-1.793c.956.262 1.964.4 3.012.4 5.523 0 10-4.145 10-9.253C22 6.145 17.523 2 12 2zm1.15 12.454l-2.545-2.716-4.963 2.716 5.458-5.796 2.35 2.716 5.155-2.716-5.455 5.796z"/>
        </svg>
      </div>
    </a>
    @endif

    @if (theme_option('google_map_link'))
    <a href="{{ theme_option('google_map_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-phone tw-w-14 tw-h-14 tw-bg-white tw-shadow-md tw-rounded-full tw-p-[10px]">
        <img src="{{ asset('storage/theme/image/google-maps.png') }}" alt="icon contact google map" class="tw-w-full tw-h-auto">
      </div>
    </a>
    @endif


  </div>
</div>

{!! Theme::footer() !!}

@php
  $dpLocale = preg_replace('/[_-].*$/', '', (string) app()->getLocale());
  $dpLocale = in_array($dpLocale, ['vi', 'ko'], true) ? $dpLocale : null;
@endphp



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js"></script>

<script>
  new WOW().init();
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    Fancybox.bind("[data-fancybox='gallery']", {
      groupAll: true,
      Thumbs: {
        autoStart: true
      },
      Toolbar: {
        display: [{
            id: "counter",
            position: "center"
          },
          "zoom",
          "slideshow",
          "fullscreen",
          "download",
          "close"
        ],
      },
      animated: true,
      dragToClose: true,
      placeFocusBack: false
    });

    try {
      document.querySelectorAll('.toc-container.table-of-content button > span.toc_toggle.show-text.tw-absolute.tw-left-0.tw-top-0.tw-w-full.tw-h-full > a')[0].innerHTML = `<svg class="svg-inline--fa fa-list-ul tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list-ul" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path></svg>

    <svg class="svg-inline--fa fa-chevron-down toc-icon tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path></svg>`;

      document.querySelectorAll('.toc-container.table-of-content button > span.toc_toggle.hide-text.tw-absolute.tw-left-0.tw-top-0.tw-w-full.tw-h-full > a')[0].innerHTML = `<svg class="svg-inline--fa fa-list-ul tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list-ul" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path></svg>

    <svg class="svg-inline--fa fa-chevron-down toc-icon tw-h-4 tw-text-[#007bff] tw-rotate-180" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path></svg>`;
    } catch (error) {

    }


    document.addEventListener('DOMContentLoaded', function () {
    const figureTables = document.querySelectorAll('figure.table');

        figureTables.forEach(function (figure) {

            if (figure.parentElement.classList.contains('table-responsive')) {
                return;
            }

            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';

            figure.parentNode.insertBefore(wrapper, figure);
            wrapper.appendChild(figure);
        });
    });
  });
</script>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
        });

    });
</script>

</body>

</html>