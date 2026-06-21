<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Unit;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $unitSd = Unit::where('unit_name', 'SD')->first();
        $unitSmp = Unit::where('unit_name', 'SMP')->first();

        // SD Subjects
        $sdSubjects = ['Matematika', 'Bahasa Indonesia', 'Ilmu Pengetahuan Alam', 'Ilmu Pengetahuan Sosial', 'Pendidikan Pancasila'];
        if ($unitSd) {
            foreach ($sdSubjects as $index => $subject) {
                Subject::firstOrCreate([
                    'subject_name' => $subject,
                    'unit_id' => $unitSd->id,
                ], [
                    'subject_code' => 'SD-SUB' . ($index + 1),
                ]);
            }
        }

        // SMP Subjects
        $smpSubjects = ['Matematika', 'Bahasa Indonesia', 'IPA Terpadu', 'IPS Terpadu', 'Bahasa Inggris', 'Informatika'];
        if ($unitSmp) {
            foreach ($smpSubjects as $index => $subject) {
                Subject::firstOrCreate([
                    'subject_name' => $subject,
                    'unit_id' => $unitSmp->id,
                ], [
                    'subject_code' => 'SMP-SUB' . ($index + 1),
                ]);
            }
        }
    }
}
