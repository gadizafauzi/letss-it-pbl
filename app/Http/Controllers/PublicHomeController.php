<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CmsHeroSection;
use App\Models\CmsStatistic;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsProgram;
use App\Models\CmsTujuanPendidikan;
use App\Models\CmsTestimonial;
use App\Models\CmsFaq;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

use Illuminate\Support\Facades\Cache;

class PublicHomeController extends Controller
{
    public function index()
    {
        $cacheTime = 60 * 60 * 24; // 24 jam

        $hero = Cache::remember('home_hero', $cacheTime, fn() => CmsHeroSection::where('page', 'home')->where('is_active', true)->first());
        
        $statistics = Cache::remember('home_statistics', $cacheTime, fn() => CmsStatistic::where('is_active', true)->orderBy('order')->get());
        
        // Optimasi: Ambil data secara global (tidak berulang di dalam loop) dan dicache
        $studentCount = Cache::remember('home_student_count', $cacheTime, fn() => Student::where('status', 'active')->count());
        $teacherCount = Cache::remember('home_teacher_count', $cacheTime, fn() => Teacher::where('status', 'active')->count());
        $classCount = Cache::remember('home_class_count', $cacheTime, fn() => SchoolClass::count());

        foreach ($statistics as $stat) {
            if ($stat->is_dynamic) {
                if ($stat->dynamic_source === 'students_count') {
                    $stat->number = $studentCount;
                } elseif ($stat->dynamic_source === 'teachers_count') {
                    $stat->number = $teacherCount;
                } elseif ($stat->dynamic_source === 'classes_count') {
                    $stat->number = $classCount;
                }
            }
        }
        
        $welcomeMessage = Cache::remember('home_welcome_message', $cacheTime, fn() => CmsWelcomeMessage::where('is_active', true)->first());
        
        $programs = Cache::remember('home_programs', $cacheTime, fn() => CmsProgram::where('is_active', true)->orderBy('order')->get());
        
        $tujuanPendidikan = Cache::remember('home_tujuan_pendidikan', $cacheTime, fn() => CmsTujuanPendidikan::where('is_active', true)->orderBy('order')->get());
        
        $testimonials = Cache::remember('home_testimonials', $cacheTime, fn() => CmsTestimonial::where('is_active', true)->orderBy('order')->get());
        
        $faqs = Cache::remember('home_faqs', $cacheTime, fn() => CmsFaq::where('page', 'home')->where('is_active', true)->orderBy('order')->get());

        $jenjang_image = Cache::remember('home_jenjang_image', $cacheTime, fn() => \App\Models\CmsSetting::where('key', 'jenjang_pendidikan_image')->first());
        $statistic_bg_image = Cache::remember('home_statistic_bg_image', $cacheTime, fn() => \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first());

        // Ambil daftar unik ekstrakurikuler yang aktif untuk ditampilkan di homepage
        $ekskuls = Cache::remember('home_ekskuls', $cacheTime, fn() => \App\Models\CmsUnitEkskul::where('is_active', true)
            ->select('title', 'icon')
            ->get()
            ->unique('title')
            ->values());

        return view('public.home.index', compact(
            'hero',
            'statistics',
            'welcomeMessage',
            'programs',
            'tujuanPendidikan',
            'testimonials',
            'faqs',
            'jenjang_image',
            'statistic_bg_image',
            'ekskuls'
        ));
    }
}
