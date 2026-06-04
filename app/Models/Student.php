<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\Unit;
use App\Models\User;


class Student extends Model
{
    protected $fillable = [

        'user_id',
        'unit_id',

        'nis',
        'nisn',
        'nik',

        'full_name',
        'gender',

        'birth_place',
        'birth_date',

        'hobby',
        'phone',
        'address',

        'father_name',
        'mother_name',
        'parent_phone',

        'photo',

        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }

    public function currentClass()
    {
        return $this->hasOne(StudentClass::class)
            ->whereHas('academicYear', function ($q) {
                $q->where('status', 'active');
            });
    }

    public function grades()
    {
        return $this->hasMany(\App\Models\Grade::class);
    }
}
