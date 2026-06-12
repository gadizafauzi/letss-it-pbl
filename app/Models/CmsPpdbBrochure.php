<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPpdbBrochure extends Model
{
    protected $table = 'cms_ppdb_brochures';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
