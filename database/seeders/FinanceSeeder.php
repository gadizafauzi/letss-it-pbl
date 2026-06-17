<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolAccount;
use App\Models\PaymentType;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Unit;
use App\Models\User;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. School Accounts
        $bankBRI = SchoolAccount::firstOrCreate(
            ['account_number' => '001122334455'],
            [
                'bank_name' => 'Bank BRI',
                'account_name' => 'Yayasan Pendidikan LETSS IT',
                'is_active' => true,
            ]
        );

        $bankBSI = SchoolAccount::firstOrCreate(
            ['account_number' => '7788990011'],
            [
                'bank_name' => 'Bank BSI',
                'account_name' => 'Yayasan Pendidikan LETSS IT',
                'is_active' => true,
            ]
        );

        // 2. Payment Types (Jenis Tagihan)
        $unitSd = Unit::where('unit_name', 'SD')->first();
        $unitSmp = Unit::where('unit_name', 'SMP')->first();

        $paymentTypes = [];

        if ($unitSd) {
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'SPP Bulanan SD', 'unit_id' => $unitSd->id],
                ['amount' => 250000]
            );
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'Uang Pangkal SD', 'unit_id' => $unitSd->id],
                ['amount' => 2000000]
            );
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'Seragam SD', 'unit_id' => $unitSd->id],
                ['amount' => 500000]
            );
        }

        if ($unitSmp) {
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'SPP Bulanan SMP', 'unit_id' => $unitSmp->id],
                ['amount' => 350000]
            );
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'Uang Pangkal SMP', 'unit_id' => $unitSmp->id],
                ['amount' => 3000000]
            );
            $paymentTypes[] = PaymentType::firstOrCreate(
                ['name' => 'Seragam SMP', 'unit_id' => $unitSmp->id],
                ['amount' => 750000]
            );
        }

        // 3. Invoices and Payments for students using Factories
        $students = Student::with('unit')->take(50)->get();

        foreach ($students as $student) {
            $applicablePaymentTypes = array_filter($paymentTypes, function($pt) use ($student) {
                return $pt->unit_id == $student->unit_id;
            });
            
            if (empty($applicablePaymentTypes)) continue;

            $pt = $applicablePaymentTypes[array_rand($applicablePaymentTypes)];

            $invoice = Invoice::factory()->create([
                'student_id' => $student->id,
                'payment_type' => $pt->name,
                'amount' => $pt->amount,
            ]);

            if ($invoice->status === 'paid') {
                Payment::factory()->create([
                    'invoice_id' => $invoice->id,
                ]);
            }
        }
    }
}
