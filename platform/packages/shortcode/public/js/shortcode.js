(function () {
  'use strict'
  $(function () {
    $.fn.serializeObject = function () {
      var obj = {}, arr = this.serializeArray()
      $.each(arr, function () {
        if (obj[this.name]) {
          if (!obj[this.name].push) obj[this.name] = [obj[this.name]]
          obj[this.name].push(this.value || '')
        } else {
          obj[this.name] = this.value || ''
        }
      })
      return obj
    }

    var $shortcodeListModal = $('#shortcode-list-modal')
    var $shortcodeModal = $('#shortcode-modal')
    var currentEditorInstance = null
    var lastFocusedEditor = null
    var lastShortcodeTrigger = null

    function isEditorInShortcodeModal(editorId) {
      if (!editorId) return false
      var $el = $('#' + editorId)
      if ($el.length === 0) return false
      return $el.closest('#shortcode-modal').length > 0
    }

    // Track which *main* editor was last focused (ignore editors inside the shortcode modal)
    $(document).on('focus click', '.editor-ckeditor, .ck-editor__editable', function () {
      var $editor = $(this).hasClass('editor-ckeditor') ? $(this) : $(this).closest('.ck-editor').prev('.editor-ckeditor')
      if ($editor.length === 0) return

      var editorId = $editor.attr('id')
      if (!editorId) return

      if (isEditorInShortcodeModal(editorId)) {
        // Do not let modal editors hijack the insertion target
        return
      }

      lastFocusedEditor = editorId
      console.log('[shortcode] lastFocusedEditor updated to', lastFocusedEditor)
    })

    // Function to find the currently active editor instance
    function getActiveEditorInstance() {
      // Priority 1: Use the editor that opened the shortcode modal
      if (currentEditorInstance) {
        if (window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[currentEditorInstance]) {
          if (!isEditorInShortcodeModal(currentEditorInstance)) {
            console.log('[shortcode] using currentEditorInstance:', currentEditorInstance)
            return currentEditorInstance
          }
        }
      }

      // Priority 2: Use the last focused editor
      if (lastFocusedEditor) {
        if (window.EDITOR && window.EDITOR.CKEDITOR && window.EDITOR.CKEDITOR[lastFocusedEditor]) {
          if (!isEditorInShortcodeModal(lastFocusedEditor)) {
            console.log('[shortcode] using lastFocusedEditor:', lastFocusedEditor)
            return lastFocusedEditor
          }
        }
      }

      // Priority 3: Find any visible and initialized editor
      if (window.EDITOR && window.EDITOR.CKEDITOR) {
        var editors = Object.keys(window.EDITOR.CKEDITOR)
        for (var i = 0; i < editors.length; i++) {
          var editorId = editors[i]
          var $editor = $('#' + editorId)
          if ($editor.length > 0 && $editor.is(':visible') && window.EDITOR.CKEDITOR[editorId]) {
            if (isEditorInShortcodeModal(editorId)) {
              continue
            }
            console.log('[shortcode] using first visible editor:', editorId)
            return editorId
          }
        }
      }

      // Fallback
      var fallback = $('.add_shortcode_btn_trigger').data('result')
      console.log('[shortcode] using fallback:', fallback)
      return fallback
    }

    function openConfig($el) {
      showModal({ href: $el.attr('href'), key: $el.data('key'), name: $el.data('name'), description: $el.data('description') })
    }

    function showModal(opts) {
      opts = opts || {}
      var href = opts.href, key = opts.key, name = opts.name, data = opts.data || {}, update = !!opts.update, previewImage = opts.previewImage || null
      $('.shortcode-admin-config').html('')
      var $btn = $('.shortcode-modal button[data-bb-toggle="shortcode-add-single"]')
      $btn.text($btn.data(update ? 'update-text' : 'add-text'))
      $('.shortcode-modal .modal-title').text(name)
      if (previewImage && previewImage !== '') $('.shortcode-modal .shortcode-preview-image-link').attr('href', previewImage).show()
      else $('.shortcode-modal .shortcode-preview-image-link').hide()
      $('.shortcode-modal').modal('show')
      var $content = $shortcodeModal.find('.modal-content')
      Botble.showLoading($content)
      $httpClient.make().post(href, data).then(function (res) {
        var html = res.data
        $('.shortcode-data-form').trigger('reset')
        $('.shortcode-input-key').val(key)
        $('.shortcode-admin-config').html(html.data)
        Botble.hideLoading($content)
        Botble.initResources()
        Botble.initMediaIntegrate()
        document.dispatchEvent(new CustomEvent('core-shortcode-config-loaded'))
      })
    }

    $('[data-bb-toggle="shortcode-item-radio"]').on('change', function () {
      $('[data-bb-toggle="shortcode-use"]').prop('disabled', false).removeClass('disabled')
    })

    $('[data-bb-toggle="shortcode-add-single"]').on('click', function (e) {
      e.preventDefault()
      var $form = $('.shortcode-modal').find('.shortcode-data-form')

      // CRITICAL: Sync all CKEditor instances in the modal to their textareas BEFORE collecting data
      console.log('[shortcode] Syncing modal editors before collecting form data')
      if (window.EDITOR && window.EDITOR.CKEDITOR) {
        $form.find('.editor-ckeditor').each(function () {
          var editorId = $(this).attr('id')
          if (editorId && window.EDITOR.CKEDITOR[editorId]) {
            var editorData = window.EDITOR.CKEDITOR[editorId].getData()
            $(this).val(editorData)
            console.log('[shortcode] ✓ Synced', editorId, 'length:', editorData.length)
          }
        })
      }

      var data = $form.serializeObject()
      console.log('[shortcode] Serialized form data:', data)

      if (data && typeof data.item_1_content === 'string') {
        console.log('[shortcode] item_1_content length:', data.item_1_content.length)
      }
      var attrs = ''
      $.each(data, function (name, val) {
        var $el = $form.find('*[name="' + name + '"]')
        var attr = $el.data('shortcode-attribute')
        if (attr && attr === 'content') return
        if (!val) return
        name = name.replace('[]', '')
        if (typeof val === 'string') {
          val = val.replace(/\"([^\\\"]*)\"/g, '“$1”').replace(/\"/g, '“')
        }
        attrs += ' ' + name + '="' + val + '"'
      })
      var content = ''
      var $content = $form.find('*[data-shortcode-attribute=content]')
      if ($content && $content.val() != null && $content.val() !== '') content = $content.val()
      var key = $(this).closest('.shortcode-modal').find('.shortcode-input-key').val()
      var editorId = getActiveEditorInstance()
      console.log('[shortcode] inserting to editorId=', editorId, 'currentEditorInstance=', currentEditorInstance)
      console.log('[shortcode] window.EDITOR.CKEDITOR keys=', window.EDITOR && window.EDITOR.CKEDITOR ? Object.keys(window.EDITOR.CKEDITOR) : null)
      var shortcode = '[' + key + attrs + ']' + content + '[/' + key + ']'
      console.log('[shortcode] built shortcode length:', shortcode.length, 'has item_1_content:', shortcode.indexOf('item_1_content=') !== -1)
      if (window.EDITOR && window.EDITOR.CKEDITOR && $('.editor-ckeditor').length > 0) {
        if (editorId && window.EDITOR.CKEDITOR[editorId]) {
          window.EDITOR.CKEDITOR[editorId].commands.execute('shortcode', shortcode)
        } else {
          console.warn('[shortcode] CKEDITOR instance not found for', editorId)
        }
      } else if ($('.editor-tinymce').length > 0) {
        if (editorId && tinymce.get(editorId)) tinymce.get(editorId).execCommand('mceInsertContent', false, shortcode)
        else console.warn('[shortcode] tinymce instance not found for', editorId)
      } else {
        document.dispatchEvent(new CustomEvent('core-insert-shortcode', { detail: { shortcode: shortcode } }))
      }
      // Avoid aria-hidden warning: remove focus from modal controls before hiding
      try {
        if (document.activeElement && typeof document.activeElement.blur === 'function') {
          document.activeElement.blur()
        }
      } catch (e) { }

      $(this).closest('.modal').modal('hide')

      // Restore focus to the trigger button after closing
      if (lastShortcodeTrigger) {
        setTimeout(function () {
          try { $(lastShortcodeTrigger).trigger('focus') } catch (e) { }
        }, 250)
      }
      currentEditorInstance = null
    })

    $(document).on('click', '[data-bb-toggle="shortcode-list-modal"]', function (event) {
      try {
        currentEditorInstance = $(event.currentTarget).data('result') || null
        lastShortcodeTrigger = event.currentTarget || null
        // Also update lastFocusedEditor when opening via button
        if (currentEditorInstance) {
          lastFocusedEditor = currentEditorInstance
        }
      } catch (e) {
        currentEditorInstance = null
      }
      console.log('[shortcode] modal opened by', currentEditorInstance, 'lastFocused:', lastFocusedEditor, event.currentTarget)
      $shortcodeListModal.modal('show')
    })

    $('[data-bb-toggle="shortcode-select"]').on('dblclick', function (e) { openConfig($(e.currentTarget)) })
    $('[data-bb-toggle="shortcode-use"]').on('click', function () { openConfig($shortcodeListModal.find('.shortcode-item-input:checked').closest('.shortcode-item-wrapper')); $('[data-bb-toggle="shortcode-item-radio"]').prop('checked', false); $('[data-bb-toggle="shortcode-use"]').prop('disabled', true).addClass('disabled') })
    $('[data-bb-toggle="shortcode-button-use"]').on('click', function (e) { openConfig($(e.currentTarget).closest('.shortcode-item-wrapper')) })

    $shortcodeModal.on('show.bs.modal', function () { $shortcodeListModal.modal('hide'); $('[data-bb-toggle="shortcode-item-radio"]').prop('checked', false); $('[data-bb-toggle="shortcode-use"]').prop('disabled', true).addClass('disabled') })

    $(document).on('ckeditor-bb-shortcode-callback', function (e) { var d = e.detail; showModal({ key: d.shortcode, href: d.options.url, previewImage: '' }) })
    $(document).on('ckeditor-bb-shortcode-edit', function (e) { var d = e.detail; var name = d.name; var $i = $('[data-bb-toggle="shortcode-select"][data-key="' + name + '"]'); var desc = $i.length > 0 ? $i.data('description') : ''; showModal({ key: name, href: $i.data('url'), data: { key: name, code: d.shortcode }, name: $i.data('name'), description: desc, previewImage: '', update: true }) })
  })
})();
