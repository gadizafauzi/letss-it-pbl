<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination.custom');

        $cmsModels = [
            \App\Models\CmsHeroSection::class,
            \App\Models\CmsStatistic::class,
            \App\Models\CmsWelcomeMessage::class,
            \App\Models\CmsProgram::class,
            \App\Models\CmsTujuanPendidikan::class,
            \App\Models\CmsTestimonial::class,
            \App\Models\CmsFaq::class,
            \App\Models\CmsSetting::class,
            \App\Models\CmsUnitEkskul::class,
            \App\Models\Student::class,
            \App\Models\Teacher::class,
            \App\Models\SchoolClass::class,
        ];
        
        foreach ($cmsModels as $model) {
            $model::observe(\App\Observers\CmsCacheObserver::class);
        }

        View::composer(['layouts.public', 'layouts.unit', 'components.public.navbar', 'components.public.footer'], function ($view) {
            $settings = \App\Models\CmsSetting::pluck('value', 'key')->all();
            $view->with('settings', $settings);
        });

        View::composer('components.teacher.sidebar', function ($view) {

            $homeroomClass = null;

            if (auth()->check() && auth()->user()->role === 'teacher') {
                $teacher = Teacher::with('position')->where('user_id', auth()->id())->first();

                if ($teacher) {
                    $activeYear = AcademicYear::where('status', 'active')->first();

                    if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
                        $homeroomClass = SchoolClass::where('homeroom_teacher_id', $teacher->id)
                            ->first();
                    }
                }
            }

            $view->with('homeroomClass', $homeroomClass);
        });
    }
}
