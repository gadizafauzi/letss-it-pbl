<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_name','category','kkm','is_sd','is_smp'
    ];

    public function teachingAssignments()
    {
        return $this->hasMany(TeachingAssignment::class);
    }
}
