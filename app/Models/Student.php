<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\Unit;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

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

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

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

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getGpaHistoryAttribute()
    {
        $enrolledYears = $this->studentClasses()
            ->with('academicYear')
            ->get()
            ->sortBy(function($sc) {
                return $sc->academicYear->year ?? '';
            });

        $gpaHistory = [];
        
        foreach ($enrolledYears as $sc) {
            $yearId = $sc->academic_year_id;
            
            // Rata-rata semester Ganjil (odd)
            $avgOdd = \App\Models\Grade::where('student_id', $this->id)
                ->where('academic_year_id', $yearId)
                ->where('semester', 'odd')
                ->where('status', 'published')
                ->whereNotNull('final_score')
                ->avg('final_score');
                
            // Rata-rata semester Genap (even)
            $avgEven = \App\Models\Grade::where('student_id', $this->id)
                ->where('academic_year_id', $yearId)
                ->where('semester', 'even')
                ->where('status', 'published')
                ->whereNotNull('final_score')
                ->avg('final_score');
                
            $gpaHistory[] = $avgOdd !== null ? round($avgOdd, 1) : 0;
            $gpaHistory[] = $avgEven !== null ? round($avgEven, 1) : 0;
        }

        while (count($gpaHistory) < 8) {
            $gpaHistory[] = 0;
        }
        
        return array_slice($gpaHistory, 0, 8);
    }

    /*
     * --------------------------------------------------------------------------
     * RELASI CMS
     * --------------------------------------------------------------------------
     */

    public function cmsAchievements()
    {
        return $this->hasMany(CmsAchievement::class, 'student_id');
    }
}

