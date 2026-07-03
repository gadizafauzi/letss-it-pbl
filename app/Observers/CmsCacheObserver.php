<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CmsCacheObserver
{
    public function saved($model)
    {
        $this->clearCache();
    }

    public function deleted($model)
    {
        $this->clearCache();
    }

    protected function clearCache()
    {
        $keys = [
            'home_hero',
            'home_statistics',
            'home_student_count',
            'home_teacher_count',
            'home_class_count',
            'home_welcome_message',
            'home_programs',
            'home_tujuan_pendidikan',
            'home_testimonials',
            'home_faqs',
            'home_jenjang_image',
            'home_statistic_bg_image',
            'home_ekskuls',
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
}
