<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory(),
            'payment_type' => fake()->randomElement(['SPP Bulanan SD', 'SPP Bulanan SMP', 'Uang Pangkal SD']),
            'period' => '2025/2026',
            'amount' => fake()->randomElement([250000, 350000, 2000000]),
            'due_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'status' => fake()->randomElement(['paid', 'unpaid']),
        ];
    }
}
