<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Unit;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $unitSd = Unit::where('unit_name', 'SD')->first();
        $unitSmp = Unit::where('unit_name', 'SMP')->first();

        // Ambil guru SD yang jabatannya Wali Kelas
        $sdTeachers = Teacher::where('unit_id', $unitSd->id ?? 0)
            ->whereHas('position', function ($q) {
                $q->where('name', 'Wali Kelas');
            })->get();

        // SD Classes: 1 to 6
        $sdClasses = ['1A', '2A', '3A', '4A', '5A', '6A'];
        foreach ($sdClasses as $index => $className) {
            $teacher = $sdTeachers[$index] ?? null;

            if ($unitSd) {
                SchoolClass::firstOrCreate(
                    ['class_name' => $className, 'unit_id' => $unitSd->id],
                    [
                        'homeroom_teacher_id' => $teacher ? $teacher->id : null,
                    ]
                );
            }
        }

        // Ambil guru SMP yang jabatannya Wali Kelas
        $smpTeachers = Teacher::where('unit_id', $unitSmp->id ?? 0)
            ->whereHas('position', function ($q) {
                $q->where('name', 'Wali Kelas');
            })->get();

        // SMP Classes: 7 to 9
        $smpClasses = ['7A', '8A', '9A'];
        foreach ($smpClasses as $index => $className) {
            $teacher = $smpTeachers[$index] ?? null;

            if ($unitSmp) {
                SchoolClass::firstOrCreate(
                    ['class_name' => $className, 'unit_id' => $unitSmp->id],
                    [
                        'homeroom_teacher_id' => $teacher ? $teacher->id : null,
                    ]
                );
            }
        }
    }
}
