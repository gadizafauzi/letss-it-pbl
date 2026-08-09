<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsUnitTeacher extends Model
{
    protected $table = 'cms_unit_teachers';

    protected $fillable = [
        'unit_id',
        'teacher_id',
        'jabatan',
        'photo',
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

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
