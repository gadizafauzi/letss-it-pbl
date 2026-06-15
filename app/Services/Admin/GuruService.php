<?php

namespace App\Services\Admin;

use App\Models\Teacher;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use App\Services\Shared\FileUploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class GuruService
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Store a new teacher and their User account.
     */
    public function storeTeacher(array $data, $photo = null): Teacher
    {
        return DB::transaction(function () use ($data, $photo) {
            if ($photo) {
                $data['photo'] = $this->fileUploadService->uploadImage($photo, 'teachers');
            }

            $user = User::create([
                'name'     => $data['full_name'],
                'username' => $data['nip'],
                'password' => Hash::make(config('auth.default_password', '12345678')),
                'role'     => 'teacher',
                'status'   => $data['status'],
            ]);

            $data['user_id'] = $user->id;

            return Teacher::create($data);
        });
    }

    /**
     * Update an existing teacher and their User account.
     */
    public function updateTeacher(Teacher $guru, array $data, $photo = null): Teacher
    {
        // Check if username (nip) is taken by another user
        if (User::where('username', $data['nip'])->where('id', '!=', $guru->user_id)->exists()) {
            throw ValidationException::withMessages([
                'nip' => 'NIP sudah digunakan sebagai username login oleh pengguna lain.'
            ]);
        }

        return DB::transaction(function () use ($guru, $data, $photo) {
            if ($photo) {
                if ($guru->photo) {
                    $this->fileUploadService->deleteImage($guru->photo);
                }
                $data['photo'] = $this->fileUploadService->uploadImage($photo, 'teachers');
            } else {
                $data['photo'] = $guru->photo;
            }

            if ($guru->user) {
                $guru->user->update([
                    'name'     => $data['full_name'],
                    'username' => $data['nip'],
                    'status'   => $data['status'],
                ]);
            }

            $guru->update($data);

            return $guru;
        });
    }

    /**
     * Delete a teacher, their photo, and their user account.
     */
    public function deleteTeacher(Teacher $guru): void
    {
        DB::transaction(function () use ($guru) {
            if ($guru->photo) {
                $this->fileUploadService->deleteImage($guru->photo);
            }

            if ($guru->user) {
                $guru->user->delete();
            }

            $guru->delete();
        });
    }

    /**
     * Process CSV row for importing a teacher.
     */
    public function processImportRow(array $row): bool
    {
        $nip  = trim($row[0] ?? '');
        $nama = trim($row[1] ?? '');

        if (!$nip || !$nama) {
            throw new \Exception("Data tidak lengkap (NIP: $nip)");
        }

        if (Teacher::where('nip', $nip)->exists()) {
            throw new \Exception("NIP $nip sudah terdaftar");
        }

        DB::transaction(function () use ($nip, $nama, $row) {
            $user = User::create([
                'name'     => $nama,
                'username' => $nip,
                'password' => Hash::make(config('auth.default_password', '12345678')),
                'role'     => 'teacher',
                'status'   => 'active',
            ]);

            $unitId = trim($row[2] ?? '');
            $positionId = trim($row[3] ?? '');

            $genderInput = strtoupper(trim($row[4] ?? ''));
            $genderMapped = $genderInput === 'L' ? 'male' : ($genderInput === 'P' ? 'female' : null);

            Teacher::create([
                'user_id'           => $user->id,
                'unit_id'           => $unitId ?: null,
                'position_id'       => $positionId ?: null,
                'nip'               => $nip,
                'full_name'         => $nama,
                'gender'            => $genderMapped,
                'birth_place'       => trim($row[5] ?? null) ?: null,
                'birth_date'        => trim($row[6] ?? null) ?: null,
                'last_education'    => trim($row[7] ?? null) ?: null,
                'phone'             => trim($row[8] ?? null) ?: null,
                'address'           => trim($row[9] ?? null) ?: null,
                'employment_status' => trim($row[10] ?? null) ?: null,
                'status'            => trim($row[11] ?? 'active') ?: 'active',
            ]);
        });

        return true;
    }
}
