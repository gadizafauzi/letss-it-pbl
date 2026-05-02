<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AcademicYear extends Model
{
    protected $fillable = [
        'year','active_semester','status',
        'start_odd','end_odd','start_even','end_even'
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
