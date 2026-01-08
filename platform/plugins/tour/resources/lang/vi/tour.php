<?php

return [
    'name' => 'Tour',
    'subpage' => 'Trang tour',
    'category' => 'Danh mục tour',
    'create' => 'Tạo mới tour',
    'settings' => 'Cài đặt',
    'settings_description' => 'Cấu hình đường dẫn (URL) cho tour.',
    'slug_prefix' => 'Tiền tố đường dẫn tour',
    'slug_prefix_helper' => 'Ví dụ: tour (không có dấu /).',
    'default_slug_prefix_en' => 'tour',
    'default_slug_prefix_vi' => 'tour',
    'view_more' => 'Xem thêm',
    'collapse' => 'Thu gọn',

    'public' => [
        'location' => 'Địa điểm',
        'duration' => 'Thời gian',
        'departure' => 'Khởi hành',
        'vehicle' => 'Phương tiện',

        'adult' => 'Người lớn',
        'child' => 'Trẻ em',
        'per_adult' => '/ người lớn',
        'per_child' => '/ trẻ em',

        'download_itinerary' => 'Tải lịch trình',
        'booking' => 'Booking',
        'information' => 'Thông tin :name',
        'policy' => 'Chính sách :name',
    ],

    'forms' => [
        'preview' => 'Xem trước',

        'tour_name' => 'Tên tour',
        'tour_link' => 'Đường dẫn tour',
        'tour_image' => 'Hình ảnh',
        'tour_gallery' => 'Thư viện ảnh',
        'tour_location' => 'Địa điểm',
        'tour_duration' => 'Thời gian',
        'tour_departure_time' => 'Khởi hành',
        'tour_vehicle' => 'Phương tiện',
        'tour_original_price' => 'Giá gốc',
        'tour_adult_price' => 'Giá người lớn',
        'tour_child_price' => 'Giá trẻ em',
        'tour_attachment' => 'File đính kèm',
        'tour_intro' => 'Mở đầu',
        'tour_content' => 'Nội dung',
        'tour_policy' => 'Chính sách',
        'tour_categories' => 'Danh mục tour',

        'placeholder_location' => 'Ví dụ: Nha Trang',
        'placeholder_duration' => 'Ví dụ: 3 ngày 2 đêm',
        'placeholder_departure_time' => 'Ví dụ: Hằng ngày / 08:00',
        'placeholder_vehicle' => 'Ví dụ: xe, cano',
        'placeholder_price' => 'Ví dụ: 3450000',

        'category_name' => 'Tên danh mục',
        'category_parent' => 'Danh mục cha',
        'category_slug' => 'Đường dẫn danh mục',
        'category_description' => 'Mô tả',
        'no_parent' => '— Không có —',
    ],

    'validation' => [
        'tour_link_regex' => 'Đường dẫn tour chỉ được chứa chữ, số và dấu gạch ngang (-). Không được chứa khoảng trắng hoặc ký tự đặc biệt.',
        'tour_link_unique' => 'Đường dẫn đã tồn tại. Vui lòng nhập đường dẫn khác.',
        'category_slug_regex' => 'Slug chỉ được chứa chữ, số và dấu gạch ngang (-). Không được chứa khoảng trắng hoặc ký tự đặc biệt.',
        'category_slug_unique' => 'Slug đã tồn tại. Vui lòng nhập slug khác.',
    ],
];
