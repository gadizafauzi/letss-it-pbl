<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\Grade;

class TeachingAssignment extends Model
{
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
        'academic_year_id',
    ];

    /**
     * RELATION: Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * RELATION: Subject
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * RELATION: Class
     */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * RELATION: Academic Year
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * RELATION: Grades
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
