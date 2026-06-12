<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CmsHeroSection;
use App\Models\CmsStatistic;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsProgram;
use App\Models\CmsKeunggulan;
use App\Models\CmsTestimonial;
use App\Models\CmsFaq;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

class PublicHomeController extends Controller
{
    public function index()
    {

        $hero = CmsHeroSection::where('page', 'home')->where('is_active', true)->first();
        
        $statistics = CmsStatistic::where('is_active', true)->orderBy('order')->get();
        foreach ($statistics as $stat) {
            if ($stat->is_dynamic) {
                if ($stat->dynamic_source === 'students_count') {
                    $stat->number = Student::where('status', 'active')->count();
                } elseif ($stat->dynamic_source === 'teachers_count') {
                    $stat->number = Teacher::where('status', 'active')->count();
                } elseif ($stat->dynamic_source === 'classes_count') {
                    $stat->number = SchoolClass::count();
                }
            }
        }
        
        $welcomeMessage = CmsWelcomeMessage::where('is_active', true)->first();
        
        $programs = CmsProgram::where('is_active', true)->orderBy('order')->get();
        
        $keunggulan = CmsKeunggulan::where('is_active', true)->orderBy('order')->get();
        
        $testimonials = CmsTestimonial::where('is_active', true)->orderBy('order')->get();
        
        $faqs = CmsFaq::where('page', 'home')->where('is_active', true)->orderBy('order')->get();

        return view('public.home.index', compact(

            'hero',
            'statistics',
            'welcomeMessage',
            'programs',
            'keunggulan',
            'testimonials',
            'faqs'
        ));
    }
}
