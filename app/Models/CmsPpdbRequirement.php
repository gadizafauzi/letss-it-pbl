<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPpdbRequirement extends Model
{
    protected $table = 'cms_ppdb_requirements';

    protected $fillable = [
        'unit_id',
        'text',
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
