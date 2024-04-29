<?php

namespace Botble\Donate\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Donation\Models\Donation;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Donate extends BaseModel
{
    protected $table = 'donates';

    protected $fillable = [
        'donation_id',
        'name',
        'email',
        'phone',
        'amount',
        'currency',
        'remark',
        'status',
    ];

    protected $casts = [
        // 'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

}
