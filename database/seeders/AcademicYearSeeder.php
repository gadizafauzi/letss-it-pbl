<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        AcademicYear::firstOrCreate(
            ['year' => '2025/2026'],
            [
                'active_semester' => 'even',
                'status' => 'active',
                'start_odd' => '2025-07-01',
                'end_odd' => '2025-12-31',
                'start_even' => '2026-01-01',
                'end_even' => '2026-06-30',
            ]
        );

        AcademicYear::firstOrCreate(
            ['year' => '2026/2027'],
            [
                'active_semester' => 'odd',
                'status' => 'inactive',
                'start_odd' => '2026-07-01',
                'end_odd' => '2026-12-31',
                'start_even' => '2027-01-01',
                'end_even' => '2027-06-30',
            ]
        );
    }
}
