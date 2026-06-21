<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Unit;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $name = fake()->firstName($gender === 'male' ? 'male' : 'female') . ' ' . fake()->lastName();

        return [
            'user_id' => User::factory()->create([
                'name' => $name,
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('12345678'),
                'role' => 'teacher',
                'status' => 'active',
            ])->id,
            'unit_id' => Unit::inRandomOrder()->first()->id ?? Unit::factory(),
            'position_id' => Position::inRandomOrder()->first()->id ?? Position::factory(),
            'nip' => '19' . fake()->numerify('########'),
            'full_name' => $name,
            'gender' => $gender,
            'birth_place' => fake()->city(),
            'birth_date' => fake()->dateTimeBetween('-45 years', '-25 years')->format('Y-m-d'),
            'last_education' => 'S1 Pendidikan',
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'employment_status' => fake()->randomElement(['pegawai_tetap', 'pegawai_tidak_tetap']),
            'status' => 'active',
        ];
    }
}
