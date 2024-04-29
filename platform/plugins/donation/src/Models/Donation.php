<?php

namespace Botble\Donation\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Donate\Models\Donate;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Donation extends BaseModel
{
    protected $table = 'donations';

    protected $fillable = [
        'name',
        'remark',
        'image',
        'amount',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];

    public function donates()
    {
        return $this->hasMany(Donate::class,'donation_id');
        // return $this->belongsToMany(Tag::class, 'post_tags');
    }

}
