<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\CmsHeroSection;
use App\Models\CmsUnitDetail;
use App\Models\CmsUnitTeacher;
use App\Models\CmsUnitEkskul;
use App\Models\CmsUnitFacility;
use App\Models\CmsAchievement;

class PublicUnitController extends Controller
{
    public function tk()
    {
        $unit = Unit::where('unit_name', 'like', '%TK%')->firstOrFail();
        $hero = CmsHeroSection::where('page', 'unit_tk')->where('is_active', true)->first();
        $detail = CmsUnitDetail::where('unit_id', $unit->id)->first();
        
        $teachers = CmsUnitTeacher::with('teacher')
            ->where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $ekskuls = CmsUnitEkskul::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $facilities = CmsUnitFacility::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $achievements = CmsAchievement::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('public.unit.tk.index', compact(
            'unit', 'hero', 'detail', 'teachers', 'ekskuls', 'facilities', 'achievements'
        ));
    }

    public function sd()
    {
        $unit = Unit::where('unit_name', 'like', '%SD%')->firstOrFail();
        $hero = CmsHeroSection::where('page', 'unit_sd')->where('is_active', true)->first();
        $detail = CmsUnitDetail::where('unit_id', $unit->id)->first();
        
        $teachers = CmsUnitTeacher::with('teacher')
            ->where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $ekskuls = CmsUnitEkskul::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $facilities = CmsUnitFacility::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $achievements = CmsAchievement::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('public.unit.sd.index', compact(
            'unit', 'hero', 'detail', 'teachers', 'ekskuls', 'facilities', 'achievements'
        ));
    }

    public function smp()
    {
        $unit = Unit::where('unit_name', 'like', '%SMP%')->firstOrFail();
        $hero = CmsHeroSection::where('page', 'unit_smp')->where('is_active', true)->first();
        $detail = CmsUnitDetail::where('unit_id', $unit->id)->first();
        
        $teachers = CmsUnitTeacher::with('teacher')
            ->where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $ekskuls = CmsUnitEkskul::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $facilities = CmsUnitFacility::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $achievements = CmsAchievement::where('unit_id', $unit->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('public.unit.smp.index', compact(
            'unit', 'hero', 'detail', 'teachers', 'ekskuls', 'facilities', 'achievements'
        ));
    }
}
