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
    var uniqueId = 'accordion_content_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    var itemId = 'item_' + uniqueId;

    wrapper.innerHTML = [
      '<div class="card-body">',
      '  <div class="d-flex justify-content-between align-items-center mb-3">',
      '    <div class="fw-bold text-primary voucher-accordion-title-toggle" style="cursor: pointer; user-select: none; flex: 1;" data-bs-toggle="collapse" data-bs-target="#' + itemId + '">',
      '      <i class="fa fa-chevron-right voucher-accordion-toggle" style="width: 16px; display: inline-block;"></i> Accordion Item',
      '    </div>',
      '    <div class="d-flex gap-2">',
      '      <div class="btn-group btn-group-sm" role="group">',
      '        <button type="button" class="btn btn-outline-secondary voucher-accordion-move-up" title="Lên trên"><i class="fa fa-arrow-up mx-auto"></i></button>',
      '        <button type="button" class="btn btn-outline-secondary voucher-accordion-move-down" title="Xuống dưới"><i class="fa fa-arrow-down mx-auto"></i></button>',
      '      </div>',
      '      <button type="button" class="btn btn-sm btn-danger voucher-accordion-remove"><i class="fa fa-trash"></i> Xóa</button>',
      '    </div>',
      '  </div>',
      '  <div id="' + itemId + '" class="collapse show">',
      '    <div class="mb-3">',
      '      <label class="form-label fw-semibold">Tiêu đề <span class="text-danger">*</span></label>',
      '      <input type="text" class="form-control voucher-accordion-title" placeholder="Nhập tiêu đề accordion..." value="' + (item.title || '').replace(/"/g, '&quot;') + '">',
      '    </div>',
      '    <div>',
      '      <label class="form-label fw-semibold">Nội dung <span class="text-danger">*</span></label>',
      '      <textarea id="' + uniqueId + '" class="form-control voucher-accordion-content" rows="4" placeholder="Nhập nội dung chi tiết...">' + (item.content || '') + '</textarea>',
      '    </div>',
      '  </div>',
      '</div>'
    ].join('');

    container.appendChild(wrapper);

    // Add collapse/expand toggle icon
    var titleToggle = wrapper.querySelector('.voucher-accordion-title-toggle');
    var toggleIcon = wrapper.querySelector('.voucher-accordion-toggle');
    var collapseEl = wrapper.querySelector('#' + itemId);

    if (titleToggle && toggleIcon && collapseEl) {
      titleToggle.addEventListener('click', function (e) {
        var isShown = collapseEl.classList.contains('show');
        if (isShown) {
          toggleIcon.classList.remove('fa-chevron-down');
          toggleIcon.classList.add('fa-chevron-right');
        } else {
          toggleIcon.classList.remove('fa-chevron-right');
          toggleIcon.classList.add('fa-chevron-down');
        }
      });
    }

    // Initialize editor with retry logic
    var retryCount = 0;
    var maxRetries = 10;
    var initEditor = function () {
      if (window.EDITOR && window.EDITOR.initCkEditor) {
        window.EDITOR.initCkEditor(uniqueId, {});
      } else if (retryCount < maxRetries) {
        retryCount++;
        setTimeout(initEditor, 300);
      }
    };

    initEditor();
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
      var emptyState = root.querySelector('.voucher-accordion-empty-state');

      function updateEmptyState() {
        var hasItems = list.querySelectorAll('.card').length > 0;
        if (emptyState) {
          emptyState.style.display = hasItems ? 'none' : 'block';
        }
      }

      function sync() {
        var current = [];
        list.querySelectorAll('.card').forEach(function (card) {
          var title = (card.querySelector('.voucher-accordion-title') || {}).value || '';
          var contentTextarea = card.querySelector('.voucher-accordion-content');
          var content = '';

          if (contentTextarea) {
            var textareaId = contentTextarea.id;
            // Get content from CKEditor if initialized
            if (window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[textareaId]) {
              content = window.EDITOR.CKEDITOR[textareaId].getData() || '';
            } else {
              content = contentTextarea.value || '';
            }
          }

          current.push({ title: title, content: content });
        });

        hidden.value = serialize(current);
        updateEmptyState();
      }

      // Initial
      list.innerHTML = '';
      // Re-add empty state after clearing
      if (emptyState) {
        var emptyClone = emptyState.cloneNode(true);
        list.appendChild(emptyClone);
        emptyState = emptyClone;
      }
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
        if (card) {
          // Destroy CKEditor instance before removing
          var contentTextarea = card.querySelector('.voucher-accordion-content');
          if (contentTextarea && window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[contentTextarea.id]) {
            window.EDITOR.CKEDITOR[contentTextarea.id].destroy();
            delete window.EDITOR.CKEDITOR[contentTextarea.id];
          }
          card.remove();
        }
        sync();
      });

      // Handle move up button
      root.addEventListener('click', function (e) {
        var btn = e.target.closest('.voucher-accordion-move-up');
        if (!btn) return;
        var card = btn.closest('.card');
        if (card && card.previousElementSibling) {
          card.parentNode.insertBefore(card, card.previousElementSibling);
          sync();
        }
      });

      // Handle move down button
      root.addEventListener('click', function (e) {
        var btn = e.target.closest('.voucher-accordion-move-down');
        if (!btn) return;
        var card = btn.closest('.card');
        if (card && card.nextElementSibling) {
          card.parentNode.insertBefore(card.nextElementSibling, card);
          sync();
        }
      });

      root.addEventListener('input', function (e) {
        if (e.target.matches('.voucher-accordion-title')) {
          sync();
        }
      });

      // Sync when form is submitted to ensure CKEditor content is captured
      var form = root.closest('form');
      if (form) {
        form.addEventListener('submit', function () {
          sync();
        });
      }
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
