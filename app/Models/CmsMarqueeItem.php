<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsMarqueeItem extends Model
{
    protected $table = 'cms_marquee_items';

    protected $fillable = [
        'text',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
