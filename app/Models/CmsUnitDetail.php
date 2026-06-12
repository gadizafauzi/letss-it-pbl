<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsUnitDetail extends Model
{
    protected $table = 'cms_unit_details';

    protected $fillable = [
        'unit_id',
        'description_title',
        'description_body',
        'description_logo',
        'target_age',
        'quota',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
