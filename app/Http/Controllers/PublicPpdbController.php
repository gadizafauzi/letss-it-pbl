<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsHeroSection;
use App\Models\Unit;
use App\Models\CmsPpdbTimeline;
use App\Models\CmsPpdbStep;
use App\Models\CmsPpdbRequirement;
use App\Models\CmsPpdbBrochure;
use App\Models\CmsFaq;

class PublicPpdbController extends Controller
{
    public function index()
    {
        $hero = CmsHeroSection::where('page', 'ppdb')->where('is_active', true)->first();
        
        $units = Unit::with('cmsUnitDetail')->get();
        
        $timeline = CmsPpdbTimeline::where('is_active', true)->orderBy('order')->get();
        
        $steps = CmsPpdbStep::where('is_active', true)->orderBy('order')->get();
        
        $requirements = CmsPpdbRequirement::where('is_active', true)->orderBy('order')->get()->groupBy('unit_id');
        
        $brochures = CmsPpdbBrochure::where('is_active', true)->orderBy('order')->get();
        
        $faqs = CmsFaq::where('page', 'ppdb')->where('is_active', true)->orderBy('order')->get();

        return view('public.ppdb.index', compact(
            'hero',
            'units',
            'timeline',
            'steps',
            'requirements',
            'brochures',
            'faqs'
        ));
    }
}
