<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsKeunggulan extends Model
{
    protected $table = 'cms_keunggulan';

    protected $fillable = [
        'icon',
        'bg_color',
        'title',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
