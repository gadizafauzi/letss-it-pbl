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
        $hero = CmsHeroSection::where('page', 'home')->where('is_active', true)->first();
        
        $statistics = CmsStatistic::where('is_active', true)->orderBy('order')->get();
        
        // Tetap menggunakan query N+1 fix (karena sangat menguntungkan performa), tapi TANPA cache
        $studentCount = Student::where('status', 'active')->count();
        $teacherCount = Teacher::where('status', 'active')->count();
        $classCount = SchoolClass::count();

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
        
        $welcomeMessage = CmsWelcomeMessage::where('is_active', true)->first();
        $programs = CmsProgram::where('is_active', true)->orderBy('order')->get();
        $tujuanPendidikan = CmsTujuanPendidikan::where('is_active', true)->orderBy('order')->get();
        $testimonials = CmsTestimonial::where('is_active', true)->orderBy('order')->get();
        $faqs = CmsFaq::where('page', 'home')->where('is_active', true)->orderBy('order')->get();

        $jenjang_image = \App\Models\CmsSetting::where('key', 'jenjang_pendidikan_image')->first();
        $statistic_bg_image = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();

        // Ambil daftar unik ekstrakurikuler yang aktif untuk ditampilkan di homepage
        $ekskuls = \App\Models\CmsUnitEkskul::where('is_active', true)
            ->select('title', 'icon')
            ->get()
            ->unique('title')
            ->values();

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
