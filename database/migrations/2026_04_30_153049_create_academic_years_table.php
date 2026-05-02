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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();

            $table->string('year')->unique();
            $table->enum('active_semester', ['odd', 'even']);
            $table->enum('status', ['active', 'inactive']);

            $table->date('start_odd');
            $table->date('end_odd');
            $table->date('start_even');
            $table->date('end_even');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
