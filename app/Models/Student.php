<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'class_id',
        'nis', 'nisn', 'full_name',
        'birth_place', 'birth_date',
        'parent_name', 'status',
        'religion', 'gender', 'address_origin', 'address_domicile', 'region', 'phone',
        'nik', 'no_kk', 'previous_education', 'marital_status', 'insurance',
        'program_study', 'department', 'education_level', 'entry_path', 'registration_status', 'photo',
        'father_name', 'mother_name', 'parent_job', 'parent_phone',
        'is_kip_kuliah', 'gpa_history'
    ];

    protected $casts = [
        'is_kip_kuliah' => 'boolean',
        'gpa_history' => 'array',
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
