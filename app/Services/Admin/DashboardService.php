<?php

namespace App\Services\Admin;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

class DashboardService
{
    /**
     * Get general statistics for the admin dashboard.
     *
     * @return array
     */
    public function getGeneralStats(): array
    {
        return [
            'totalSiswa' => Student::count(),
            'totalGuru'  => Teacher::count(),
            'totalKelas' => SchoolClass::count(),
        ];
    }
}
