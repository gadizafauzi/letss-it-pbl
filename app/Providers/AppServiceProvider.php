<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
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
