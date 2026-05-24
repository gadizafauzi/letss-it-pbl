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

        $academicYear = AcademicYear::first();

        SchoolClass::create([
            'class_name' => '5A',
            'room' => 'Ruang 1',
            'level' => 'sd',

            // Guru 1 jadi wali kelas
            'homeroom_teacher_id' => $teacher1->id,

            'academic_year_id' => $academicYear->id,
        ]);

        SchoolClass::create([
            'class_name' => '5B',
            'room' => 'Ruang 2',
            'level' => 'sd',

            // guru biasa
            'homeroom_teacher_id' => null,

            'academic_year_id' => $academicYear->id,
        ]);
    }
}
