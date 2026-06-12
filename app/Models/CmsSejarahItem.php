<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSejarahItem extends Model
{
    protected $table = 'cms_sejarah_items';

    protected $fillable = [
        'year',
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
