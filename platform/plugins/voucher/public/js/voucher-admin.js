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
      return (payload && payload.categories) ? payload.categories : [];
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

    const initialCategory = categorySelect.value;

    async function refresh() {
      const providerId = providerSelect.value;
      const categories = await fetchCategories(providerId);
      setOptions(categorySelect, categories, initialCategory);
    }

    providerSelect.addEventListener('change', function () {
      categorySelect.value = '';
      refresh();
    });

    refresh();
  });
})();
