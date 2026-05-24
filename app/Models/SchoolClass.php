<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Unit;
use App\Models\Teacher;
use App\Models\StudentClass;


class SchoolClass extends Model
{
    protected $table = 'classes';

    protected $fillable = [

        'unit_id',
        'class_name',
        'homeroom_teacher_id',

    ];

    /**
     * =========================================================
     * RELATION UNIT
     * =========================================================
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * =========================================================
     * RELATION WALI KELAS
     * =========================================================
     */
    public function homeroomTeacher()
    {
        return $this->belongsTo(
            Teacher::class,
            'homeroom_teacher_id'
        );
    }

    /**
     * =========================================================
     * RELATION STUDENT CLASS
     * =========================================================
     */
    public function studentClasses()
    {
        return $this->hasMany(
            StudentClass::class,
            'class_id'
        );
    }
}