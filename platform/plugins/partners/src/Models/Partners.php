<?php

namespace Botble\Partners\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class Partners extends BaseModel
{
    protected $table = 'partners';

    protected $fillable = [
        'name',
        'image',
        'link',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];
}
