<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            $table->string('payment_type');
            $table->string('period');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');

            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');

            $table->unique(
                ['student_id', 'payment_type', 'period'],
                'invoice_unique'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
