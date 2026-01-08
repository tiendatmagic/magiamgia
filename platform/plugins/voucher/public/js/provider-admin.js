(function () {
  function safeJsonParse(value, fallback) {
    try {
      return JSON.parse(value);
    } catch (e) {
      return fallback;
    }
  }

  function serialize(items) {
    return JSON.stringify(items.map(function (it) {
      return {
        title: (it.title || '').trim(),
        content: (it.content || '').trim(),
      };
    }).filter(function (it) {
      return it.title !== '' || it.content !== '';
    }));
  }

  function renderItem(container, item) {
    var wrapper = document.createElement('div');
    wrapper.className = 'card mb-2';

    wrapper.innerHTML = [
      '<div class="card-body">',
      '  <div class="d-flex justify-content-between align-items-center mb-2">',
      '    <div class="fw-semibold">Accordion item</div>',
      '    <button type="button" class="btn btn-sm btn-danger voucher-accordion-remove">&times;</button>',
      '  </div>',
      '  <div class="mb-2">',
      '    <label class="form-label">Tiêu đề</label>',
      '    <input type="text" class="form-control voucher-accordion-title" value="' + (item.title || '').replace(/"/g, '&quot;') + '">',
      '  </div>',
      '  <div>',
      '    <label class="form-label">Nội dung</label>',
      '    <textarea class="form-control voucher-accordion-content" rows="3">' + (item.content || '') + '</textarea>',
      '  </div>',
      '</div>'
    ].join('');

    container.appendChild(wrapper);
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Accordion field handler
    document.querySelectorAll('.voucher-accordion-field').forEach(function (root) {
      var valueRaw = root.getAttribute('data-value') || '[]';
      var items = Array.isArray(valueRaw) ? valueRaw : safeJsonParse(valueRaw, []);
      if (!Array.isArray(items)) items = [];

      var list = root.querySelector('.voucher-accordion-items');
      var hidden = root.querySelector('.voucher-accordion-json');
      var addBtn = root.querySelector('.voucher-accordion-add');

      function sync() {
        var current = [];
        list.querySelectorAll('.card').forEach(function (card) {
          var title = (card.querySelector('.voucher-accordion-title') || {}).value || '';
          var content = (card.querySelector('.voucher-accordion-content') || {}).value || '';
          current.push({ title: title, content: content });
        });

        hidden.value = serialize(current);
      }

      // Initial
      list.innerHTML = '';
      items.forEach(function (it) { renderItem(list, it || {}); });
      sync();

      addBtn.addEventListener('click', function () {
        renderItem(list, { title: '', content: '' });
        sync();
      });

      root.addEventListener('click', function (e) {
        var btn = e.target.closest('.voucher-accordion-remove');
        if (!btn) return;
        var card = btn.closest('.card');
        if (card) card.remove();
        sync();
      });

      root.addEventListener('input', function (e) {
        if (e.target.matches('.voucher-accordion-title, .voucher-accordion-content')) {
          sync();
        }
      });
    });

    // Tags chip input: transform input[name="tags"] into a chip editor
    (function initVoucherTagsChip() {
      var input = document.querySelector('input[name="tags"]');
      if (!input) return;

      function parseTags(str) {
        if (Array.isArray(str)) return str;
        if (typeof str !== 'string') return [];
        return str
          .split(',')
          .map(function (s) { return s.trim(); })
          .filter(function (s) { return s.length > 0; });
      }

      var tags = parseTags(input.value || '');

      // Keep the original input for form submission, but hide it
      input.type = 'hidden';

      // Build chip UI
      var wrapper = document.createElement('div');
      wrapper.className = 'voucher-tags-chip';

      var chipList = document.createElement('div');
      chipList.className = 'voucher-chip-list d-flex flex-wrap gap-1 mb-2';

      var entry = document.createElement('input');
      entry.type = 'text';
      entry.className = 'form-control voucher-chip-entry';
      entry.placeholder = 'Nhập tag và nhấn Enter';

      wrapper.appendChild(chipList);
      wrapper.appendChild(entry);

      input.parentNode.insertBefore(wrapper, input.nextSibling);

      function syncHidden() {
        input.value = tags.join(', ');
      }

      function render() {
        chipList.innerHTML = '';
        tags.forEach(function (t, idx) {
          var chip = document.createElement('span');
          chip.className = 'badge bg-warning d-inline-flex align-items-center text-white';
          chip.dataset.index = String(idx);

          var text = document.createElement('span');
          text.textContent = t;
          text.className = 'me-1';

          var btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'btn-close btn-close-white btn-sm ms-1 voucher-chip-remove';
          btn.setAttribute('aria-label', 'Remove');

          chip.appendChild(text);
          chip.appendChild(btn);
          chipList.appendChild(chip);
        });
        syncHidden();
      }

      function addTag(raw) {
        if (!raw) return;
        // Allow multiple comma-separated entries at once
        var parts = parseTags(raw);
        if (!parts.length) return;
        parts.forEach(function (p) {
          if (tags.indexOf(p) === -1) tags.push(p);
        });
        render();
      }

      function removeTagAt(index) {
        if (index >= 0 && index < tags.length) {
          tags.splice(index, 1);
          render();
        }
      }

      // Initial render
      render();

      // Events
      chipList.addEventListener('click', function (e) {
        var btn = e.target.closest('.voucher-chip-remove');
        if (!btn) return;
        var chip = btn.closest('[data-index]');
        if (!chip) return;
        var idx = parseInt(chip.dataset.index, 10);
        removeTagAt(idx);
      });

      entry.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
          e.preventDefault();
          var value = entry.value.trim();
          if (value) {
            addTag(value);
            entry.value = '';
          }
        } else if (e.key === 'Backspace' && entry.value === '') {
          // Remove last tag when input is empty
          removeTagAt(tags.length - 1);
        }
      });

      entry.addEventListener('blur', function () {
        var value = entry.value.trim();
        if (value) {
          addTag(value);
          entry.value = '';
        }
      });

      entry.addEventListener('paste', function (e) {
        var text = (e.clipboardData || window.clipboardData).getData('text');
        if (text && text.indexOf(',') !== -1) {
          e.preventDefault();
          addTag(text);
          entry.value = '';
        }
      });
    })();
  });
})();
