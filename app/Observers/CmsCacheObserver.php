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
            'home_hero_v2',
            'home_statistics_v2',
            'home_student_count_v2',
            'home_teacher_count_v2',
            'home_class_count_v2',
            'home_welcome_message_v2',
            'home_programs_v2',
            'home_tujuan_pendidikan_v2',
            'home_testimonials_v2',
            'home_faqs_v2',
            'home_jenjang_image_v2',
            'home_statistic_bg_image_v2',
            'home_ekskuls_v2',
        ];

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }
}
