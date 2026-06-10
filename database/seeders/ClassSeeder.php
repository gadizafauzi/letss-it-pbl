<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\AcademicYear;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $teacher1 = Teacher::where('nip', '1987654321')->first();
        $unitSd = \App\Models\Unit::where('unit_name', 'SD')->first();

        SchoolClass::create([
            'class_name' => '5A',
            'unit_id' => $unitSd->id,
            // Guru 1 jadi wali kelas
            'homeroom_teacher_id' => $teacher1->id,
        ]);

        SchoolClass::create([
            'class_name' => '5B',
            'unit_id' => $unitSd->id,
            // guru biasa
            'homeroom_teacher_id' => null,
        ]);
    }
}
