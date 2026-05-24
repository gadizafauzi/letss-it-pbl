<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'academic_year_id',
    ];

    // RELASI KE SISWA
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // RELASI KE KELAS
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // RELASI KE TAHUN AJARAN
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
