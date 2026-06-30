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

        $unitTk = \App\Models\Unit::firstOrCreate(['unit_name' => 'TK']);
        $unitSd = \App\Models\Unit::firstOrCreate(['unit_name' => 'SD']);
        $unitSmp = \App\Models\Unit::firstOrCreate(['unit_name' => 'SMP']);

        // Jabatan
        $posisiKepsek = Position::firstOrCreate(['name' => 'Kepala Sekolah']);
        $posisiWaka = Position::firstOrCreate(['name' => 'Wakil Kepala Sekolah']);
        $posisiWaliKelas = Position::firstOrCreate(['name' => 'Wali Kelas']);
        $posisiGuruMapel = Position::firstOrCreate(['name' => 'Guru Mata Pelajaran']);

        /*
        |--------------------------------------------------------------------------
        | PRINCIPALS & VICE-PRINCIPALS
        |--------------------------------------------------------------------------
        */
        // Kepala Sekolah TK: Titik Putrianti, S.Pd.I
        $userKepalaTk = User::factory()->create([
            'name' => 'Titik Putrianti, S.Pd.I',
            'username' => 'kepalatk',
            'email' => 'kepalatk@mail.com',
            'role' => 'teacher',
        ]);
        Teacher::factory()->create([
            'user_id' => $userKepalaTk->id,
            'unit_id' => $unitTk->id,
            'position_id' => $posisiKepsek->id,
            'nip' => '198765001',
            'full_name' => $userKepalaTk->name,
        ]);

        // Kepala Sekolah SD: Yenti Nofita, S.Pd.SD
        $userKepalaSd = User::factory()->create([
            'name' => 'Yenti Nofita, S.Pd.SD',
            'username' => 'kepalasd',
            'email' => 'kepalasd@mail.com',
            'role' => 'teacher',
        ]);
        Teacher::factory()->create([
            'user_id' => $userKepalaSd->id,
            'unit_id' => $unitSd->id,
            'position_id' => $posisiKepsek->id,
            'nip' => '198765002',
            'full_name' => $userKepalaSd->name,
        ]);

        // Waka SD: Nopel Darti, S.Pd
        $userWakaSd = User::factory()->create([
            'name' => 'Nopel Darti, S.Pd',
            'username' => 'wakasd',
            'email' => 'wakasd@mail.com',
            'role' => 'teacher',
        ]);
        Teacher::factory()->create([
            'user_id' => $userWakaSd->id,
            'unit_id' => $unitSd->id,
            'position_id' => $posisiWaka->id,
            'nip' => '198765003',
            'full_name' => $userWakaSd->name,
        ]);

        // Kepala Sekolah SMP: Febria Zilda, S.Si
        $userKepalaSmp = User::factory()->create([
            'name' => 'Febria Zilda, S.Si',
            'username' => 'kepalasmp',
            'email' => 'kepalasmp@mail.com',
            'role' => 'teacher',
        ]);
        Teacher::factory()->create([
            'user_id' => $userKepalaSmp->id,
            'unit_id' => $unitSmp->id,
            'position_id' => $posisiKepsek->id,
            'nip' => '198765004',
            'full_name' => $userKepalaSmp->name,
        ]);

        // Waka SMP: Ummul Khairi, S.Pd
        $userWakaSmp = User::factory()->create([
            'name' => 'Ummul Khairi, S.Pd',
            'username' => 'wakasmp',
            'email' => 'wakasmp@mail.com',
            'role' => 'teacher',
        ]);
        Teacher::factory()->create([
            'user_id' => $userWakaSmp->id,
            'unit_id' => $unitSmp->id,
            'position_id' => $posisiWaka->id,
            'nip' => '198765005',
            'full_name' => $userWakaSmp->name,
        ]);

        /*
        |--------------------------------------------------------------------------
        | TEACHER TK (2 Teachers) - Wali Kelas
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 2; $i++) {
            $user = User::factory()->create([
                'username' => 'gurutk' . $i,
                'email' => 'gurutk' . $i . '@mail.com',
                'role' => 'teacher',
            ]);
            Teacher::factory()->create([
                'user_id' => $user->id,
                'unit_id' => $unitTk->id,
                'position_id' => $posisiWaliKelas->id,
                'nip' => '198765100' . $i,
                'full_name' => $user->name,
            ]);
        }

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
