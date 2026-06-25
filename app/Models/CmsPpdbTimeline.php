<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPpdbTimeline extends Model
{
    protected $table = 'cms_ppdb_timeline';

    protected $fillable = [
        'title',
        'card_title',
        'description',
        'date_range',
        'status',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
