<?php

namespace App\Services\Admin;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use App\Services\Shared\FileUploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaService
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Store a new student along with their User account and Class assignment.
     */
    public function storeStudent(array $data, $photo = null): Student
    {
        return DB::transaction(function () use ($data, $photo) {
            if ($photo) {
                $data['photo'] = $this->fileUploadService->uploadImage($photo, 'students');
            }

            $user = User::create([
                'name'     => $data['full_name'],
                'username' => $data['nis'],
                'password' => Hash::make(config('auth.default_password', '12345678')),
                'role'     => 'student',
                'status'   => 'active',
            ]);

            $data['user_id'] = $user->id;
            
            $student = Student::create($data);

            if (!empty($data['class_id']) && !empty($data['academic_year_id'])) {
                StudentClass::create([
                    'student_id'       => $student->id,
                    'class_id'         => $data['class_id'],
                    'academic_year_id' => $data['academic_year_id'],
                ]);
            }

            return $student;
        });
    }

    /**
     * Update an existing student, including photo and class assignment.
     */
    public function updateStudent(Student $siswa, array $data, $photo = null): Student
    {
        return DB::transaction(function () use ($siswa, $data, $photo) {
            if ($photo) {
                if ($siswa->photo) {
                    $this->fileUploadService->deleteImage($siswa->photo);
                }
                $data['photo'] = $this->fileUploadService->uploadImage($photo, 'students');
            } else {
                $data['photo'] = $siswa->photo; // Keep old photo
            }

            if ($siswa->user) {
                $siswa->user->update([
                    'name'     => $data['full_name'],
                    'username' => $data['nis'],
                ]);
            }

            $siswa->update($data);

            if (!empty($data['class_id']) && !empty($data['academic_year_id'])) {
                StudentClass::where('student_id', $siswa->id)->delete();
                StudentClass::create([
                    'student_id'       => $siswa->id,
                    'class_id'         => $data['class_id'],
                    'academic_year_id' => $data['academic_year_id'],
                ]);
            }

            return $siswa;
        });
    }

    /**
     * Delete a student, their photo, and their user account.
     */
    public function deleteStudent(Student $siswa): void
    {
        DB::transaction(function () use ($siswa) {
            if ($siswa->photo) {
                $this->fileUploadService->deleteImage($siswa->photo);
            }

            if ($siswa->user) {
                $siswa->user->delete();
            }

            $siswa->delete();
        });
    }

    /**
     * Process CSV row for importing a student.
     */
    public function processImportRow(array $row): bool
    {
        $nis  = trim($row[0] ?? '');
        $nisn = trim($row[1] ?? '');
        $nik  = trim($row[2] ?? '') ?: null;
        $nama = trim($row[3] ?? '');
        
        $classId = trim($row[4] ?? '');
        $unitId  = trim($row[5] ?? '');
        $parentPhone = trim($row[6] ?? '');
        $gender = trim($row[7] ?? '');
        $birthPlace = trim($row[8] ?? '');
        $birthDate = trim($row[9] ?? '');
        $hobby = trim($row[10] ?? '');
        $phone = trim($row[11] ?? '');
        $address = trim($row[12] ?? '');
        $fatherName = trim($row[13] ?? '');
        $motherName = trim($row[14] ?? '');

        if (!$nis || !$nama) {
            throw new \Exception("Data tidak lengkap (NIS/Nama kosong)");
        }

        if (Student::where('nis', $nis)->exists()) {
            throw new \Exception("NIS $nis sudah terdaftar");
        }

        DB::transaction(function () use ($nis, $nisn, $nik, $nama, $classId, $unitId, $parentPhone, $gender, $birthPlace, $birthDate, $hobby, $phone, $address, $fatherName, $motherName) {
            $user = User::create([
                'name'     => $nama,
                'username' => $nis,
                'password' => Hash::make(config('auth.default_password', '12345678')),
                'role'     => 'student',
                'status'   => 'active',
            ]);

            $student = Student::create([
                'user_id'      => $user->id,
                'unit_id'      => $unitId ?: null,
                'nis'          => $nis,
                'nisn'         => $nisn,
                'nik'          => $nik,
                'full_name'    => $nama,
                'gender'       => $gender ?: null,
                'birth_place'  => $birthPlace ?: null,
                'birth_date'   => $birthDate ?: null,
                'hobby'        => $hobby ?: null,
                'phone'        => $phone ?: null,
                'address'      => $address ?: null,
                'father_name'  => $fatherName ?: null,
                'mother_name'  => $motherName ?: null,
                'parent_phone' => $parentPhone ?: null,
                'status'       => 'active',
            ]);

            $activeYear = \App\Models\AcademicYear::where('status', 'active')->first();

            if ($classId && $activeYear) {
                \App\Models\StudentClass::create([
                    'student_id'       => $student->id,
                    'class_id'         => $classId,
                    'academic_year_id' => $activeYear->id,
                ]);
            }
        });

        return true;
    }
}
