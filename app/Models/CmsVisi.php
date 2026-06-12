<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsVisi extends Model
{
    protected $table = 'cms_visi';

    protected $fillable = [
        'text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
