<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    protected static int $studentCounter = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['L', 'P']);
        $name = fake()->firstName($gender === 'L' ? 'male' : 'female') . ' ' . fake()->lastName();

        $counter = self::$studentCounter++;
        $username = 'siswa' . $counter;
        $nis = date('Y') . str_pad($counter, 4, '0', STR_PAD_LEFT);
        $nisn = '01234' . str_pad($counter, 5, '0', STR_PAD_LEFT);

        return [
            'user_id' => User::factory()->create([
                'name' => $name,
                'username' => $username,
                'email' => $username . '@mail.com',
                'password' => Hash::make('12345678'),
                'role' => 'student',
                'status' => 'active',
            ])->id,
            'unit_id' => Unit::inRandomOrder()->first()->id ?? Unit::factory(),
            'nis' => $nis,
            'nisn' => $nisn,
            'nik' => fake()->numerify('1302############'),
            'full_name' => $name,
            'gender' => $gender,
            'birth_place' => fake()->city(),
            'birth_date' => fake()->dateTimeBetween('-15 years', '-10 years')->format('Y-m-d'),
            'hobby' => fake()->randomElement(['Membaca', 'Olahraga', 'Menyanyi', 'Melukis', 'Berenang', 'Bermain Musik']),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'father_name' => fake()->name('male'),
            'mother_name' => fake()->name('female'),
            'parent_phone' => fake()->phoneNumber(),
            'status' => 'active',
        ];
    }
}
