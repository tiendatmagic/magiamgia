<?php

return [
  [
    'name' => 'Voucher',
    'flag' => 'voucher.index',
  ],
  [
    'name' => 'Nhà cung cấp',
    'flag' => 'voucher-provider.index',
    'parent_flag' => 'voucher.index',
  ],
  [
    'name' => 'Mã giảm giá',
    'flag' => 'voucher-coupon.index',
    'parent_flag' => 'voucher.index',
  ],
];
