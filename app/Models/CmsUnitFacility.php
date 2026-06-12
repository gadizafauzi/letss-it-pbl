<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsUnitFacility extends Model
{
    protected $table = 'cms_unit_facilities';

    protected $fillable = [
        'unit_id',
        'icon',
        'title',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
