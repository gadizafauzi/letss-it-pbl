<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Unit;
use App\Models\Position;
use App\Models\TeachingAssignment;
use App\Models\SchoolClass;


class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'unit_id',
        'position_id',
        'nip',
        'full_name',
        'gender',
        'birth_place',
        'birth_date',
        'last_education',
        'phone',
        'address',
        'employment_status',
        'status',
        'photo',
    ];

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI UNIT
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // RELASI MENGAJAR
    public function teachingAssignments()
    {
        return $this->hasMany(TeachingAssignment::class);
    }

    // WALI KELAS
    public function homeroomClasses()
    {
        return $this->hasMany(SchoolClass::class, 'homeroom_teacher_id');
    }

    //JABATAN
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    
}
