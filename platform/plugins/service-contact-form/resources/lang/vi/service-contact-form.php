<?php

return [
    'name' => 'Service Contact Form',
    'description' => 'Mẫu form liên hệ cho trang chi tiết dịch vụ',

    'settings' => [
        'template_label' => 'Form liên hệ (chi tiết dịch vụ)',
        'template_help' => 'Dùng placeholder: [[action]], [[csrf]], [[service_title]], [[service_id]].',
    ],

    'form' => [
        'title' => 'FORM THÔNG TIN',
        'service_selected_label' => 'Dịch vụ đang chọn',
        'name_label' => 'Họ và Tên',
        'name_placeholder' => 'Nhập họ và tên',
        'phone_label' => 'Số điện thoại',
        'phone_placeholder' => 'Nhập số điện thoại',
        'date_label' => 'Ngày đi',
        'date_placeholder' => 'Chọn ngày đi',
        'submit' => 'Gửi thông tin',
    ],
];
