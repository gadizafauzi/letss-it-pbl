<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\TeachingAssignment;
use App\Models\AcademicYear;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $academicYear = AcademicYear::where('status', 'active')->first();
        if (!$academicYear) {
            $this->command->warn('⚠️ Tidak ada Academic Year yang aktif. Proses seeding Dummy Data di-skip.');
            return;
        }

        $classes = SchoolClass::with('unit')->get();

        foreach ($classes as $class) {
            // 1. Generate Siswa untuk tiap kelas
            $existingCount = \App\Models\StudentClass::where('class_id', $class->id)->count();
            $needed = 20 - $existingCount;

            if ($needed > 0) {
                $students = Student::factory()->count($needed)->create([
                    'unit_id' => $class->unit_id,
                ]);

                foreach ($students as $student) {
                    \App\Models\StudentClass::create([
                        'student_id' => $student->id,
                        'class_id' => $class->id,
                        'academic_year_id' => $academicYear->id,
                    ]);
                }
            }

            // 2. Generate Jadwal Mengajar (Teaching Assignments) secara acak
            $subjects = Subject::where('unit_id', $class->unit_id)->get();
            $teachers = Teacher::where('unit_id', $class->unit_id)->get();

            if ($teachers->count() > 0 && $subjects->count() > 0) {
                // Pilih maksimal 3 mata pelajaran acak untuk kelas ini
                $randomSubjects = $subjects->random(min(3, $subjects->count()));
                
                foreach ($randomSubjects as $subject) {
                    // Pilih 1 guru acak untuk mengajar mata pelajaran ini
                    $randomTeacher = $teachers->random();

                    TeachingAssignment::firstOrCreate([
                        'teacher_id' => $randomTeacher->id,
                        'subject_id' => $subject->id,
                        'class_id' => $class->id,
                        'academic_year_id' => $academicYear->id,
                    ]);
                }
            }
        }
    }
}
