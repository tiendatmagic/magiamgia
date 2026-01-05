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
      var data = $form.serializeObject()
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
      var editorId = currentEditorInstance || $('.add_shortcode_btn_trigger').data('result')
      console.debug('[shortcode] inserting to editorId=', editorId, 'currentEditorInstance=', currentEditorInstance)
      console.debug('[shortcode] window.EDITOR.CKEDITOR keys=', window.EDITOR && window.EDITOR.CKEDITOR ? Object.keys(window.EDITOR.CKEDITOR) : null)
      var shortcode = '[' + key + attrs + ']' + content + '[/' + key + ']'
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
      $(this).closest('.modal').modal('hide')
      currentEditorInstance = null
    })

    $(document).on('click', '[data-bb-toggle="shortcode-list-modal"]', function (event) {
      try { currentEditorInstance = $(event.currentTarget).data('result') || null } catch (e) { currentEditorInstance = null }
      console.debug('[shortcode] modal opened by', currentEditorInstance, event.currentTarget)
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
