<?php

namespace Botble\Volunteer\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Volunteer extends BaseModel
{
    protected $table = 'volunteers';

    protected $fillable = [
        'name',
        'status',
        'contract_start_date',
        'id_card_front',
        'id_card_back',
        'image',
        'cv',
        'education_level',
        'position',
        'experience_level',
        'remark',
    ];

    protected $casts = [
        'name' => SafeContent::class,
    ];
}
