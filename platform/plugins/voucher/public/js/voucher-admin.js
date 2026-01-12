(function () {
  async function fetchCategories(providerId) {
    if (!providerId) return [];

    try {
      const url = new URL(window.location.origin + '/admin/voucher/providers/' + providerId + '/categories');
      const res = await fetch(url.toString(), {
        headers: {
          'Accept': 'application/json'
        }
      });
      const data = await res.json();
      const payload = data.data || data;
      const categories = (payload && payload.categories) ? payload.categories : [];
      return categories;
    } catch (e) {
      return [];
    }
  }

  function setOptions(select, categories, selectedValue) {
    select.innerHTML = '';

    const empty = document.createElement('option');
    empty.value = '';
    empty.textContent = '-- Chọn danh mục --';
    select.appendChild(empty);

    categories.forEach(function (cat) {
      const opt = document.createElement('option');
      opt.value = cat;
      opt.textContent = cat;
      if (selectedValue && selectedValue === cat) {
        opt.selected = true;
      }
      select.appendChild(opt);
    });

  }

  document.addEventListener('DOMContentLoaded', function () {
    const providerSelect = document.querySelector('select[name="provider_id"]');
    const categorySelect = document.querySelector('select[name="category"]');
    if (!providerSelect || !categorySelect) return;

    let initialCategory = categorySelect.getAttribute('data-saved-value') || '';

    async function refresh() {
      const providerId = providerSelect.value;
      const categories = await fetchCategories(providerId);
      setOptions(categorySelect, categories, initialCategory);
    }

    // Load categories on page load (preserves saved category for edit pages)
    refresh();

    providerSelect.addEventListener('change', function () {
      categorySelect.value = '';
      initialCategory = '';
      refresh();
    });
  });

  // Show discount unit badge (% or VND) next to "Giảm bao nhiêu" label
  document.addEventListener('DOMContentLoaded', function () {
    const discountTypeSelect = document.querySelector('select[name="discount_type"]');
    const discountLabel = document.querySelector('label[for="discount_value"]');
    if (!discountTypeSelect || !discountLabel) return;

    let badge = discountLabel.querySelector('[data-discount-unit-indicator]');
    if (!badge) {
      badge = document.createElement('span');
      badge.className = 'badge ms-2 bg-white';
      badge.setAttribute('data-discount-unit-indicator', '');
      discountLabel.appendChild(badge);
    }

    const updateBadge = function () {
      const val = discountTypeSelect.value;
      badge.textContent = val === 'percent' ? '%' : 'VND';
    };

    updateBadge();
    discountTypeSelect.addEventListener('change', updateBadge);
  });

  // Initialize datetime picker with time support for expired_at field
  document.addEventListener('DOMContentLoaded', function () {
    // Check for flatpickr date picker
    const datePickerWrappers = document.querySelectorAll('.datepicker');
    datePickerWrappers.forEach(function (wrapper) {
      const input = wrapper.querySelector('input[name="expired_at"]');
      if (!input) return;

      const enableTime = input.getAttribute('data-enable-time') === 'true' || input.getAttribute('data-enable-time') === '1';
      const dateFormat = input.getAttribute('data-date-format') || 'Y-m-d';

      if (enableTime && typeof flatpickr !== 'undefined') {
        // Re-initialize with time enabled
        const fpInstance = input._flatpickr;
        if (fpInstance) {
          fpInstance.destroy();
        }

        flatpickr(wrapper, {
          dateFormat: dateFormat,
          enableTime: true,
          time_24hr: true,
          wrap: true,
          locale: window.siteEditorLocale === 'vi' ? 'vn' : (window.siteEditorLocale || 'en'),
        });
      }
    });

    // Fallback: Bootstrap datetimepicker if available
    var $picker = jQuery('#datetimepicker-expired_at');
    if ($picker.length > 0 && typeof moment !== 'undefined' && jQuery.fn.datetimepicker) {
      $picker.datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        stepping: 1,
        useCurrent: false,
        showTodayButton: true,
        showClear: true,
        showClose: true,
        icons: {
          today: 'ti ti-calendar-check',
          clear: 'ti ti-x',
          close: 'ti ti-x',
          date: 'ti ti-calendar',
          up: 'ti ti-chevron-up',
          down: 'ti ti-chevron-down',
          previous: 'ti ti-chevron-left',
          next: 'ti ti-chevron-right',
          time: 'ti ti-clock'
        }
      });
    }
  });
})();
