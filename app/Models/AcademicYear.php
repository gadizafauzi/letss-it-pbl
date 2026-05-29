<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\StudentClass;

class AcademicYear extends Model
{
    protected $table = 'academic_years';

    protected $fillable = [

        'year',
        'active_semester',
        'status',

        'start_odd',
        'end_odd',

        'start_even',
        'end_even',
    ];

    protected $casts = [

        'start_odd' => 'date',
        'end_odd' => 'date',

        'start_even' => 'date',
        'end_even' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
