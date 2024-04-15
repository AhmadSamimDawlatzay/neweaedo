<?php

namespace Botble\Project\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Project extends BaseModel
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'status',
        'image',
        'descripton',
        'date',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];
}
