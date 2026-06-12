<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsAchievement extends Model
{
    protected $table = 'cms_achievements';

    protected $fillable = [
        'type',
        'unit_id',
        'teacher_id',
        'student_id',
        'year',
        'title',
        'description',
        'level',
        'side',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
