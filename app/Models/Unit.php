<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unit_name'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /*
     * --------------------------------------------------------------------------
     * RELASI CMS
     * --------------------------------------------------------------------------
     */

    public function cmsUnitDetail()
    {
        return $this->hasOne(CmsUnitDetail::class, 'unit_id');
    }

    public function cmsUnitTeachers()
    {
        return $this->hasMany(CmsUnitTeacher::class, 'unit_id');
    }

    public function cmsUnitEkskuls()
    {
        return $this->hasMany(CmsUnitEkskul::class, 'unit_id');
    }

    public function cmsUnitFacilities()
    {
        return $this->hasMany(CmsUnitFacility::class, 'unit_id');
    }

    public function cmsAchievements()
    {
        return $this->hasMany(CmsAchievement::class, 'unit_id');
    }

    public function cmsPpdbRequirements()
    {
        return $this->hasMany(CmsPpdbRequirement::class, 'unit_id');
    }
}

