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

        $heroData = Cache::remember('home_hero', $cacheTime, function() {
            $model = CmsHeroSection::where('page', 'home')->where('is_active', true)->first();
            return $model ? $model->getAttributes() : null;
        });
        // Guard: flush corrupt cache
        if (!is_null($heroData) && !is_array($heroData)) {
            Cache::forget('home_hero');
            $model = CmsHeroSection::where('page', 'home')->where('is_active', true)->first();
            $heroData = $model ? $model->getAttributes() : null;
        }
        $hero = $heroData ? CmsHeroSection::hydrate([$heroData])->first() : null;
        
        $statisticsData = Cache::remember('home_statistics', $cacheTime, function() {
            return CmsStatistic::where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        });
        // Guard: if cached value is corrupt (not an array of arrays), flush and re-fetch
        if (!is_array($statisticsData) || (!empty($statisticsData) && !is_array(reset($statisticsData)))) {
            Cache::forget('home_statistics');
            $statisticsData = CmsStatistic::where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        }
        $statistics = CmsStatistic::hydrate($statisticsData);
        
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
        
        $welcomeMessageData = Cache::remember('home_welcome_message', $cacheTime, function() {
            $model = CmsWelcomeMessage::where('is_active', true)->first();
            return $model ? $model->getAttributes() : null;
        });
        $welcomeMessage = $welcomeMessageData ? CmsWelcomeMessage::hydrate([$welcomeMessageData])->first() : null;
        
        $programsData = Cache::remember('home_programs', $cacheTime, function() {
            return CmsProgram::where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        });
        $programs = CmsProgram::hydrate($programsData);
        
        $tujuanPendidikanData = Cache::remember('home_tujuan_pendidikan', $cacheTime, function() {
            return CmsTujuanPendidikan::where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        });
        $tujuanPendidikan = CmsTujuanPendidikan::hydrate($tujuanPendidikanData);
        
        $testimonialsData = Cache::remember('home_testimonials', $cacheTime, function() {
            return CmsTestimonial::where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        });
        $testimonials = CmsTestimonial::hydrate($testimonialsData);
        
        $faqsData = Cache::remember('home_faqs', $cacheTime, function() {
            return CmsFaq::where('page', 'home')->where('is_active', true)->orderBy('order')->get()->map->getAttributes()->all();
        });
        $faqs = CmsFaq::hydrate($faqsData);

        $jenjangImageData = Cache::remember('home_jenjang_image', $cacheTime, function() {
            $model = \App\Models\CmsSetting::where('key', 'jenjang_pendidikan_image')->first();
            return $model ? $model->getAttributes() : null;
        });
        $jenjang_image = $jenjangImageData ? \App\Models\CmsSetting::hydrate([$jenjangImageData])->first() : null;

        $statisticBgImageData = Cache::remember('home_statistic_bg_image', $cacheTime, function() {
            $model = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
            return $model ? $model->getAttributes() : null;
        });
        $statistic_bg_image = $statisticBgImageData ? \App\Models\CmsSetting::hydrate([$statisticBgImageData])->first() : null;

        // Ambil daftar unik ekstrakurikuler yang aktif untuk ditampilkan di homepage
        $ekskulsData = Cache::remember('home_ekskuls', $cacheTime, function() {
            return \App\Models\CmsUnitEkskul::where('is_active', true)
                ->select('title', 'icon')
                ->get()
                ->unique('title')
                ->values()
                ->map->getAttributes()
                ->all();
        });
        $ekskuls = \App\Models\CmsUnitEkskul::hydrate($ekskulsData);

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
