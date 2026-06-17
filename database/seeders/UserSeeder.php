<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        $unitSd = \App\Models\Unit::firstOrCreate(['unit_name' => 'SD']);
        $unitSmp = \App\Models\Unit::firstOrCreate(['unit_name' => 'SMP']);

        // Jabatan
        $posisiWaliKelas = Position::firstOrCreate(['name' => 'Wali Kelas']);
        $posisiGuruMapel = Position::firstOrCreate(['name' => 'Guru Mata Pelajaran']);

        /*
        |--------------------------------------------------------------------------
        | TEACHER SD (6 Teachers for 6 Classes) - Wali Kelas
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 6; $i++) {
            $user = User::factory()->create([
                'username' => 'gurusd' . $i,
                'email' => 'gurusd' . $i . '@mail.com',
                'role' => 'teacher',
            ]);
            
            Teacher::factory()->create([
                'user_id' => $user->id,
                'unit_id' => $unitSd->id,
                'position_id' => $posisiWaliKelas->id,
                'nip' => '198765432' . $i,
                'full_name' => $user->name,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHER SMP (3 Teachers for 3 Classes) - Wali Kelas
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 3; $i++) {
            $user = User::factory()->create([
                'username' => 'gurusmp' . $i,
                'email' => 'gurusmp' . $i . '@mail.com',
                'role' => 'teacher',
            ]);

            Teacher::factory()->create([
                'user_id' => $user->id,
                'unit_id' => $unitSmp->id,
                'position_id' => $posisiWaliKelas->id,
                'nip' => '198765432' . ($i + 6),
                'full_name' => $user->name,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | GURU MATA PELAJARAN SD (4 Teachers)
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 4; $i++) {
            $user = User::factory()->create([
                'username' => 'gurumapelsd' . $i,
                'email' => 'gurumapelsd' . $i . '@mail.com',
                'role' => 'teacher',
            ]);

            Teacher::factory()->create([
                'user_id' => $user->id,
                'unit_id' => $unitSd->id,
                'position_id' => $posisiGuruMapel->id,
                'nip' => '19876543' . ($i + 29),
                'full_name' => $user->name,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | GURU MATA PELAJARAN SMP (4 Teachers)
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 4; $i++) {
            $user = User::factory()->create([
                'username' => 'gurumapelsmp' . $i,
                'email' => 'gurumapelsmp' . $i . '@mail.com',
                'role' => 'teacher',
            ]);

            Teacher::factory()->create([
                'user_id' => $user->id,
                'unit_id' => $unitSmp->id,
                'position_id' => $posisiGuruMapel->id,
                'nip' => '19876543' . ($i + 33),
                'full_name' => $user->name,
            ]);
        }
    }
}
