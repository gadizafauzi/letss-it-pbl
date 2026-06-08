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

        if (!$nis || !$nisn || !$nama) {
            throw new \Exception("Data tidak lengkap (NIS: $nis)");
        }

        if (Student::where('nis', $nis)->exists()) {
            throw new \Exception("NIS $nis sudah terdaftar");
        }

        DB::transaction(function () use ($nis, $nisn, $nik, $nama, $row) {
            $user = User::create([
                'name'     => $nama,
                'username' => $nis,
                'password' => Hash::make(config('auth.default_password', '12345678')),
                'role'     => 'student',
                'status'   => 'active',
            ]);

            Student::create([
                'user_id'      => $user->id,
                'nis'          => $nis,
                'nisn'         => $nisn,
                'nik'          => $nik,
                'full_name'    => $nama,
                'gender'       => trim($row[4] ?? null) ?: null,
                'birth_place'  => trim($row[5] ?? null) ?: null,
                'birth_date'   => trim($row[6] ?? null) ?: null,
                'address'      => trim($row[7] ?? null) ?: null,
                'father_name'  => trim($row[8] ?? null) ?: null,
                'mother_name'  => trim($row[9] ?? null) ?: null,
                'parent_phone' => trim($row[10] ?? null) ?: null,
                'status'       => trim($row[11] ?? 'active') ?: 'active',
            ]);
        });

        return true;
    }
}
