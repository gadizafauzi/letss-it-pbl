<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // TEACHER
        $teacherUser = User::create([
            'name' => 'Guru 1',
            'username' => 'guru1',
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
            'status' => 'active',
        ]);

        Teacher::create([
            'user_id' => $teacherUser->id,
            'nip' => '1987654321',
            'full_name' => 'Guru 1',
            'status' => 'active',
        ]);

        // STUDENT
        $studentUser = User::create([
            'name' => 'Siswa 1',
            'username' => 'siswa1',
            'password' => Hash::make('12345678'),
            'role' => 'student',
            'status' => 'active',
        ]);

        Student::create([
            'user_id' => $studentUser->id,
            'nis' => '12345',
            'nisn' => '9876543210',
            'full_name' => 'Siswa 1',
            'status' => 'active',
        ]);
    }
}
