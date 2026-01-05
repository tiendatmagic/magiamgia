<?php

return [
    'name' => 'Service Contact Form',
    'description' => '서비스 상세 페이지 문의 양식 템플릿',

    'settings' => [
        'template_label' => '문의 양식 (서비스 상세)',
        'template_help' => '사용 가능한 플레이스홀더: [[action]], [[csrf]], [[service_title]], [[service_id]].',
    ],

    'form' => [
        'title' => '입력 양식',
        'service_selected_label' => '선택된 서비스',
        'name_label' => '성명',
        'name_placeholder' => '성명을 입력하세요',
        'phone_label' => '전화번호',
        'phone_placeholder' => '전화번호를 입력하세요',
        'date_label' => '출발 날짜',
        'date_placeholder' => '출발 날짜를 선택하세요',
        'submit' => '정보 보내기',
    ],
];
