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
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $unit1 = \App\Models\Unit::create(['unit_name' => 'SMP']);
        $unit2 = \App\Models\Unit::create(['unit_name' => 'SD']);

        /*
        |--------------------------------------------------------------------------
        | TEACHER 1 - WALI KELAS
        |--------------------------------------------------------------------------
        */

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
            'unit_id' => $unit1->id,
            'nip' => '1987654321',
            'full_name' => 'Guru 1',
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | TEACHER 2 - GURU BIASA
        |--------------------------------------------------------------------------
        */

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
            'unit_id' => $unit2->id,
            'nip' => '1987654322',
            'full_name' => 'Guru 2',
            'status' => 'active',
        ]);
    }
}
