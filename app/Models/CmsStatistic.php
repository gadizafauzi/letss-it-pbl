<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsStatistic extends Model
{
    protected $table = 'cms_statistics';

    protected $fillable = [
        'icon',
        'number',
        'suffix',
        'label',
        'is_dynamic',
        'dynamic_source',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_dynamic' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
