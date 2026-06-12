<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsProgram extends Model
{
    protected $table = 'cms_programs';

    protected $fillable = [
        'icon',
        'title',
        'description',
        'detail',
        'category',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
