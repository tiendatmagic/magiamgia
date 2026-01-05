@php
    /** @var \Botble\BigsoftService\Models\BigsoftService|mixed $service */

    $template = setting('service_detail_contact_form_template');

    if (! $template) {
        $template = \Botble\ServiceContactForm\Support\ServiceContactFormTemplate::defaultTemplate();
    }

    $template = str_replace(
        [
            'Chọn ngày đi / 출발 날짜',
            'Chọn ngày đi /출발 날짜',
            'Chọn ngày đi/ 출발 날짜',
            'Chọn ngày đi/출발 날짜',
        ],
        '[[t_date_placeholder]]',
        $template
    );

    $rendered = strtr($template, [
        '[[action]]' => route('public.submit.contact.form'),
        '[[csrf]]' => csrf_field(),
        '[[service_title]]' => e(data_get($service, 'name', '')),
        '[[service_id]]' => (string) data_get($service, 'id', ''),
        '[[t_form_title]]' => trans('plugins/service-contact-form::service-contact-form.form.title'),
        '[[t_service_selected_label]]' => trans('plugins/service-contact-form::service-contact-form.form.service_selected_label'),
        '[[t_name_label]]' => trans('plugins/service-contact-form::service-contact-form.form.name_label'),
        '[[t_name_placeholder]]' => trans('plugins/service-contact-form::service-contact-form.form.name_placeholder'),
        '[[t_phone_label]]' => trans('plugins/service-contact-form::service-contact-form.form.phone_label'),
        '[[t_phone_placeholder]]' => trans('plugins/service-contact-form::service-contact-form.form.phone_placeholder'),
        '[[t_date_label]]' => trans('plugins/service-contact-form::service-contact-form.form.date_label'),
        '[[t_date_placeholder]]' => trans('plugins/service-contact-form::service-contact-form.form.date_placeholder'),
        '[[t_submit]]' => trans('plugins/service-contact-form::service-contact-form.form.submit'),
    ]);
@endphp

{!! $rendered !!}
