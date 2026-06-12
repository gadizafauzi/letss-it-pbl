<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPpdbStep extends Model
{
    protected $table = 'cms_ppdb_steps';

    protected $fillable = [
        'step_number',
        'icon',
        'title',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'step_number' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
