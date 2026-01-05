
<article class="post post--single">
  <header class="post__header">
    <h1 class="post__title">
    {{ $service->name }}
    </h1>
    <div class="post__meta"></div>
  </header>
  <div class="post__content">
    <div class="ck-content">
    @php
      $content = (string) ($service->content ?? '');

      $content = preg_replace('/&(amp;)?#0*91;|&(amp;)?lbrack;|&(amp;)?#x0*5b;/i', '[', $content);
      $content = preg_replace('/&(amp;)?#0*93;|&(amp;)?rbrack;|&(amp;)?#x0*5d;/i', ']', $content);

      $content = preg_replace_callback('/\[[^\]]+\]/s', function (array $matches) {
          $tag = $matches[0];

          if (! preg_match('/^\[\/?[A-Za-z0-9_-]+(?:\s|\]|$)/', $tag)) {
              return $tag;
          }

          return html_entity_decode($tag, ENT_QUOTES, 'UTF-8');
      }, $content);
    @endphp

    {!! do_shortcode($content) !!}
    </div>
  </div>
</article>

@if (function_exists('is_plugin_active') && is_plugin_active('service-contact-form'))
  {!! view('plugins/service-contact-form::service-detail-form', ['service' => $service])->render() !!}
@endif
