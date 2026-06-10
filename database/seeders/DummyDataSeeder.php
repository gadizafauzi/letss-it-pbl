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
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan Academic Year ada
        $academicYear = AcademicYear::first() ?? AcademicYear::create([
            'year' => '2025/2026',
            'active_semester' => 'even',
            'status' => 'active',
            'start_odd' => '2025-07-01',
            'end_odd' => '2025-12-31',
            'start_even' => '2026-01-01',
            'end_even' => '2026-06-30',
        ]);

        // 2. Pastikan Guru 1 dan Guru 2 ada
        $teacher1 = Teacher::first();
        if (!$teacher1) {
            $teacherUser1 = User::create([
                'name' => 'Guru 1',
                'username' => 'guru1',
                'email' => 'guru1@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
                'status' => 'active',
            ]);
            $teacher1 = Teacher::create([
                'user_id' => $teacherUser1->id,
                'nip' => '1987654321',
                'full_name' => 'Guru 1',
                'status' => 'active',
            ]);
        }

        $teacher2 = Teacher::skip(1)->first();
        if (!$teacher2) {
            $teacherUser2 = User::create([
                'name' => 'Guru 2',
                'username' => 'guru2',
                'email' => 'guru2@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
                'status' => 'active',
            ]);
            $teacher2 = Teacher::create([
                'user_id' => $teacherUser2->id,
                'nip' => '1987654322',
                'full_name' => 'Guru 2',
                'status' => 'active',
            ]);
        }

        // 3. Buat Kelas
        $classes = [];
        $classNames = ['5A', '5B', '6A', '6B'];
        $unit = \App\Models\Unit::first();
        foreach ($classNames as $index => $className) {
            $classes[] = SchoolClass::firstOrCreate(
                ['class_name' => $className],
                [
                    'unit_id' => $unit->id,
                    'homeroom_teacher_id' => ($index === 0) ? $teacher1->id : (($index === 1) ? $teacher2->id : null),
                ]
            );
        }

        // 4. Buat Mata Pelajaran
        $subjects = [];
        $subjectNames = ['Matematika', 'Bahasa Indonesia', 'IPA', 'IPS', 'Bahasa Inggris'];
        foreach ($subjectNames as $index => $subjectName) {
            $subjects[] = Subject::firstOrCreate(
                ['subject_name' => $subjectName],
                [
                    'unit_id' => $unit->id,
                    'subject_code' => 'SUB' . ($index + 1),
                ]
            );
        }

        // 5. Buat 20 Siswa per Kelas
        $studentCounter = 1;
        foreach ($classes as $class) {
            // Hitung siswa yang sudah ada di kelas ini
            $existingCount = \App\Models\StudentClass::where('class_id', $class->id)->count();
            $needed = 20 - $existingCount;

            for ($i = 0; $i < $needed; $i++) {
                while (User::where('username', 'siswa' . $studentCounter)->exists() || User::where('email', 'siswa' . $studentCounter . '@mail.com')->exists()) {
                    $studentCounter++;
                }

                $nis = '2026' . str_pad($studentCounter, 4, '0', STR_PAD_LEFT);
                $nisn = '01234' . str_pad($studentCounter, 5, '0', STR_PAD_LEFT);
                $name = 'Siswa ' . $studentCounter . ' Kelas ' . $class->class_name;

                // Jika siswa1, kita buat data Siswa 1
                if ($studentCounter === 1) {
                    $nis = '2024001';
                    $nisn = '0081234567';
                    $name = 'Siswa 1';
                }

                $user = User::create([
                    'name' => $name,
                    'username' => 'siswa' . $studentCounter,
                    'email' => 'siswa' . $studentCounter . '@mail.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'student',
                    'status' => 'active',
                ]);

                $studentData = [
                    'user_id' => $user->id,
                    'unit_id' => $unit->id,
                    'nis' => $nis,
                    'nisn' => $nisn,
                    'full_name' => $name,
                    'status' => 'active',
                ];

                if ($studentCounter === 1) {
                    $studentData = array_merge($studentData, [
                        'birth_place' => 'koto Baru',
                        'birth_date' => '2006-04-01',
                        'religion' => 'Islam',
                        'gender' => 'P',
                        'address_origin' => 'Jorong Simpang, Koto Baru',
                        'address_domicile' => 'Pasar Baru, Jamsek, jln. Muhammad Hatta, Cupak Tangah Padang',
                        'region' => 'Kabupaten Solok (Sumatera Barat)',
                        'phone' => '08979825465',
                        'nik' => '1302104104060004',
                        'no_kk' => '1302101106110001',
                        'previous_education' => 'SMA',
                        'marital_status' => 'Belum Menikah',
                        'insurance' => 'Tidak ada data asuransi',
                        
                        'program_study' => 'D-4 Teknologi Rekayasa Perangkat Lunak',
                        'department' => 'Jurusan Teknologi Informasi',
                        'education_level' => 'Sarjana Terapan (D-4)',
                        'entry_path' => 'Seleksi Mandiri Konsorsium Politeknik Negeri',
                        'registration_status' => 'Sudah Terdaftar',
                        'photo' => null,
                        
                        'father_name' => 'Nama Ayah Siswa 1',
                        'mother_name' => 'Nama Ibu Siswa 1',
                        'parent_job' => 'Swasta',
                        'parent_phone' => '085126270009',
                        
                        'is_kip_kuliah' => true,
                        'gpa_history' => json_encode([3.2, 3.1, 3.8, 3.0, 3.2, 3.5, 3.7, 3.9]),
                    ]);
                }

                $student = Student::create($studentData);

                \App\Models\StudentClass::create([
                    'student_id' => $student->id,
                    'class_id' => $class->id,
                    'academic_year_id' => $academicYear->id,
                ]);

                $studentCounter++;
            }
        }

        // Buat Invoice dan Pembayaran dummy untuk siswa1
        $student1 = Student::where('nis', '2024001')->first();
        if ($student1) {
            $invoice = \App\Models\Invoice::create([
                'student_id' => $student1->id,
                'payment_type' => 'UKT Semester 1',
                'period' => '2025-Ganjil',
                'amount' => 7500000,
                'due_date' => '2025-08-31',
                'status' => 'paid'
            ]);

            \App\Models\Payment::create([
                'invoice_id' => $invoice->id,
                'verified_by' => $teacher1->user_id,
                'payment_date' => '2025-08-15',
                'payment_proof' => 'bukti_pembayaran_semester_1.png'
            ]);
        }

        // 6. Buat Penugasan Mengajar (Teaching Assignment) untuk Guru 1 & Guru 2
        // Guru 1 mengajar Matematika di 5A dan Bahasa Indonesia di 6A
        TeachingAssignment::firstOrCreate([
            'teacher_id' => $teacher1->id,
            'subject_id' => $subjects[0]->id, // Matematika
            'class_id' => $classes[0]->id, // 5A
            'academic_year_id' => $academicYear->id,
        ]);

        TeachingAssignment::firstOrCreate([
            'teacher_id' => $teacher1->id,
            'subject_id' => $subjects[1]->id, // Bahasa Indonesia
            'class_id' => $classes[2]->id, // 6A
            'academic_year_id' => $academicYear->id,
        ]);

        // Guru 2 mengajar IPA di 5B dan IPS di 6B
        TeachingAssignment::firstOrCreate([
            'teacher_id' => $teacher2->id,
            'subject_id' => $subjects[2]->id, // IPA
            'class_id' => $classes[1]->id, // 5B
            'academic_year_id' => $academicYear->id,
        ]);

        // Guru 2 mengajar IPS di 6B dan Bahasa Inggris di 5A
        TeachingAssignment::firstOrCreate([
            'teacher_id' => $teacher2->id,
            'subject_id' => $subjects[3]->id, // IPS
            'class_id' => $classes[3]->id, // 6B
            'academic_year_id' => $academicYear->id,
        ]);
    }
}
