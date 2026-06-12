<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsUnitEkskul extends Model
{
    protected $table = 'cms_unit_ekskul';

    protected $fillable = [
        'unit_id',
        'icon',
        'title',
        'description',
        'image',
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
