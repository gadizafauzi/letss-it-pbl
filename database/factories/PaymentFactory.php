<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\SchoolAccount;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'verified_by' => User::where('role', 'admin')->first()->id ?? null,
            'payment_method' => 'transfer',
            'school_account_id' => SchoolAccount::inRandomOrder()->first()->id ?? null,
            'payment_date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'payment_proof' => 'bukti_tf_' . fake()->randomNumber(5) . '.jpg',
            'verification_status' => 'verified',
        ];
    }
}
