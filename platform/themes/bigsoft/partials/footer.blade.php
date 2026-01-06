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

$footerSupportTitle = theme_option('footer_support_title') ?: 'Tổng đài hỗ trợ';
$footerSupportRegionNorthLabel = theme_option('footer_support_region_north_label') ?: 'Phía Bắc & Trung';
$footerSupportRegionSouthLabel = theme_option('footer_support_region_south_label') ?: 'Phía Nam';
$footerSupportLabelSales = theme_option('footer_support_label_sales') ?: 'Mua hàng';
$footerSupportLabelWarranty = theme_option('footer_support_label_warranty') ?: 'Bảo hành';
$footerSupportTimeLabel = theme_option('footer_support_time_label') ?: 'Thời gian';

$footerZaloLabel = theme_option('footer_zalo_label') ?: 'Chat Zalo';
$footerZaloIcon = theme_option('footer_zalo_icon');
$footerCertTitle = theme_option('footer_cert_title') ?: 'Đã chứng nhận';
$footerBctLink = theme_option('footer_bct_link');
$footerBctImage = theme_option('footer_bct_image');
// Contact values (show only if provided)
$contact_phone_north_sales = theme_option('contact_phone_north_sales');
$contact_phone_north_warranty = theme_option('contact_phone_north_warranty');
$contact_phone_south_sales = theme_option('contact_phone_south_sales');
$contact_phone_south_warranty = theme_option('contact_phone_south_warranty');
$working_hours_val = theme_option('working_hours');
$working_hours_sat_val = theme_option('working_hours_sat');
$contact_email_val = theme_option('contact_email');
$footerAddressHnLabel = trim((string) theme_option('footer_address_hn_label')) ?: null;
$footerAddressHcmLabel = trim((string) theme_option('footer_address_hcm_label')) ?: null;
@endphp

<footer class="tw-bg-white tw-pt-10 tw-pb-8 tw-border-t tw-border-gray-200">
  <div class="tw-container tw-mx-auto tw-px-4 tw-max-w-7xl">

    <div class="row footerTop">

      <div class="col-md-4 col-lg-3 tw-mb-4">
        <h3 class="tw-font-bold tw-text-gray-900 tw-text-base tw-mb-4">{{ $footerSupportTitle }}</h3>
        <div>
          <div class="tw-mb-4">
            <p class="tw-font-bold tw-flex tw-items-center tw-mb-2.5">
              <i class="fa fa-phone-square tw-rotate-90 tw-text-[#da251c]"></i>
              <span class="tw-mr-2 tw-text-sm tw-ml-1 tw-font-bold">{{ $footerSupportRegionNorthLabel }}</span>
            </p>
            @if ($contact_phone_north_sales)
            <p class="tw-mb-2.5 tw-font-medium">{{ $footerSupportLabelSales }}: <a
                href="tel:{{ preg_replace('/\D/', '', $contact_phone_north_sales) }}"
                class="tw-text-blue-600 tw-font-bold">{{ $contact_phone_north_sales }}</a></p>
            @endif
            @if ($contact_phone_north_warranty)
            <p class="tw-mb-2.5 tw-font-medium">{{ $footerSupportLabelWarranty }}: <a
                href="tel:{{ preg_replace('/\D/', '', $contact_phone_north_warranty) }}"
                class="tw-text-blue-600 tw-font-bold">{{ $contact_phone_north_warranty }}</a></p>
            @endif
          </div>

          <div class="tw-mb-4">
            <p class="tw-font-bold tw-flex tw-items-center tw-mb-2.5">
              <i class="fa fa-phone-square tw-rotate-90 tw-text-[#da251c]"></i>
              <span class="tw-mr-2 tw-text-sm tw-ml-1 tw-font-medium">{{ $footerSupportRegionSouthLabel }}</span>
            </p>
            @if ($contact_phone_south_sales)
            <p class="tw-mb-2.5 tw-font-medium">{{ $footerSupportLabelSales }}: <a
                href="tel:{{ preg_replace('/\D/', '', $contact_phone_south_sales) }}"
                class="tw-text-blue-600 tw-font-bold">{{ $contact_phone_south_sales }}</a></p>
            @endif
            @if ($contact_phone_south_warranty)
            <p class="tw-mb-2.5 tw-font-medium">{{ $footerSupportLabelWarranty }}: <a
                href="tel:{{ preg_replace('/\D/', '', $contact_phone_south_warranty) }}"
                class="tw-text-blue-600 tw-font-bold">{{ $contact_phone_south_warranty }}</a></p>
            @endif
          </div>

          <div class="tw-mb-4">
            <div class="tw-font-medium tw-flex tw-items-center tw-mb-2">
              <div class="tw-inline-block">
                <svg class="tw-text-[#da251c] tw-fill-[#da251c] tw-w-3.5 tw-h-3.5 tw-rotate-[230deg]"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z" />
                </svg>
              </div>
              <span class="tw-mr-2 tw-text-sm tw-ml-1 tw-font-bold">
                {{ $footerSupportTimeLabel }}
              </span>
            </div>
            @if ($working_hours_val)
            <p class="tw-mb-2.5">{{ $working_hours_val }}</p>
            @endif
            @if ($working_hours_sat_val)
            <p class="tw-mb-2.5">{{ $working_hours_sat_val }}</p>
            @endif
          </div>
          @php
          $zaloIconUrl = $footerZaloIcon ? RvMedia::getImageUrl($footerZaloIcon) :
          'https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg';
          @endphp

          @if (theme_option('zalo_link') || $footerZaloIcon)
          <div class="tw-flex tw-items-center tw-space-x-2">
            @if (theme_option('zalo_link'))
            <a href="{{ theme_option('zalo_link') }}" target="_blank" rel="nofollow"
              class="tw-flex tw-items-center tw-space-x-2">
              <span class="tw-font-bold">{{ $footerZaloLabel }}</span>
              <img src="{{ $zaloIconUrl }}" class="tw-w-6 tw-h-6" alt="Zalo">
            </a>
            @else
            <span class="tw-font-bold">{{ $footerZaloLabel }}</span>
            <img src="{{ $zaloIconUrl }}" class="tw-w-6 tw-h-6" alt="Zalo">
            @endif
          </div>
          @endif
        </div>
      </div>

      {!! dynamic_sidebar('footer_sidebar') !!}

      <div class="col-md-12 col-lg-3 tw-mb-4 sm:tw-mb-0">
        <h3 class="tw-font-bold tw-text-gray-900 tw-text-base lg:tw-mb-4 md:tw-mb-0">Kết nối với chúng tôi</h3>

        <ul class="social social--simple tw-flex lg:tw-block tw-flex-wrap tw-justify-center">
          @if ($socialLinks = Theme::getSocialLinks())
          @foreach($socialLinks as $socialLink)
          @continue(! $icon = $socialLink->getIconHtml())
          <li class="tw-flex tw-flex-col lg:tw-flex-row tw-items-center lg:tw-w-full">
            <a {{ $socialLink->getAttributes() }}>
              {{ $icon }}
            </a>
            <span class="tw-hidden sm:tw-block">{{ $socialLink->getName() }}</span>
          </li>
          @endforeach
          @endif
        </ul>
      </div>
    </div>

    <div
      class="tw-border-t tw-border-gray-200 tw-pt-2 tw-flex tw-flex-col lg:tw-flex-row tw-justify-between tw-gap-6 tw-text-[13px] tw-leading-relaxed">
      <div class="lg:tw-w-1/2">
        <div>

          @if (theme_option('footer_description'))
          <div class="widget__content">
            <h4 class="tw-text-lg tw-uppercase tw-mb-2">{{ theme_option('site_title') }}</h4>
            <p class="tw-whitespace-pre-wrap tw-mb-2">{{ theme_option('footer_description') }}</p>
          </div>
          @endif
        </div>
      </div>

      <div class="lg:tw-w-1/2 lg:tw-text-left">
        <div>
          @if (theme_option('address_hn'))
          <p class="tw-text-sm tw-mb-2.5">
            @if ($footerAddressHnLabel)
            <span class="tw-font-bold">{{ $footerAddressHnLabel }}:</span>
            @endif
            {{ theme_option('address_hn') }}
          </p>
          @endif

          @if (theme_option('address_hcm'))
          <p class="tw-text-sm tw-mb-2.5">
            @if ($footerAddressHcmLabel)
            <span class="tw-font-bold">{{ $footerAddressHcmLabel }}:</span>
            @endif
            {{ theme_option('address_hcm') }}
          </p>
          @endif

          @if (theme_option('contact_email'))
          <p class="tw-text-sm tw-mb-1.5"><span class="tw-font-bold">Email:</span>
            <a href="mailto:{{ theme_option('contact_email') }}"
              class="tw-text-blue-600 hover:tw-underline">{{ theme_option('contact_email') }}</a>
          </p>
          @endif
        </div>

      </div>
    </div>
  </div>

  <div class="tw-container tw-mx-auto tw-px-4 tw-max-w-7xl">
    @if($copyright = theme_option('copyright'))
    <div class="col-md-8 col-sm-6">
      <div class="page-copyright tw-block  {{ $footerCopyrightAlignmentClass }}">
        <p>{!! Theme::getSiteCopyright() !!}</p>
      </div>
    </div>
    @endif
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
      <div
        class="icon-fb tw-w-14 tw-h-14 tw-bg-[#0482ff] tw-shadow-md tw-rounded-full tw-p-[10px] tw-flex tw-items-center tw-justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" class="tw-text-white"
          fill="currentColor">
          <path
            d="M12 2C6.477 2 2 6.145 2 11.254c0 2.91 1.452 5.51 3.726 7.222V22l3.262-1.793c.956.262 1.964.4 3.012.4 5.523 0 10-4.145 10-9.253C22 6.145 17.523 2 12 2zm1.15 12.454l-2.545-2.716-4.963 2.716 5.458-5.796 2.35 2.716 5.155-2.716-5.455 5.796z" />
        </svg>
      </div>
    </a>
    @endif

    @if (theme_option('google_map_link'))
    <a href="{{ theme_option('google_map_link') }}" target="_blank" class="contact-icon-link" rel="nofollow">
      <div class="icon-phone tw-w-14 tw-h-14 tw-bg-white tw-shadow-md tw-rounded-full tw-p-[10px]">
        <img src="{{ asset('storage/theme/image/google-maps.png') }}" alt="icon contact google map"
          class="tw-w-full tw-h-auto">
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.vi.min.js">
</script>

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
      document.querySelectorAll(
          '.toc-container.table-of-content button > span.toc_toggle.show-text.tw-absolute.tw-left-0.tw-top-0.tw-w-full.tw-h-full > a'
        )[0].innerHTML =
        `<svg class="svg-inline--fa fa-list-ul tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list-ul" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path></svg>

    <svg class="svg-inline--fa fa-chevron-down toc-icon tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path></svg>`;

      document.querySelectorAll(
          '.toc-container.table-of-content button > span.toc_toggle.hide-text.tw-absolute.tw-left-0.tw-top-0.tw-w-full.tw-h-full > a'
        )[0].innerHTML =
        `<svg class="svg-inline--fa fa-list-ul tw-h-4 tw-text-[#007bff]" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="list-ul" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path></svg>

    <svg class="svg-inline--fa fa-chevron-down toc-icon tw-h-4 tw-text-[#007bff] tw-rotate-180" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path></svg>`;
    } catch (error) {

    }


    document.addEventListener('DOMContentLoaded', function() {
      const figureTables = document.querySelectorAll('figure.table');

      figureTables.forEach(function(figure) {

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