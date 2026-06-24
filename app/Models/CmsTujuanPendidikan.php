<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsTujuanPendidikan extends Model
{
    protected $table = 'cms_tujuan_pendidikan';

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
