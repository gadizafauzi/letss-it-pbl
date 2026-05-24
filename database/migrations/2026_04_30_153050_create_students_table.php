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
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            // LOGIN RELATION
            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            // UNIT RELATION
            $table->foreignId('unit_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // SCHOOL DATA
            $table->string('nis')->nullable()->unique();

            $table->string('nisn')->nullable()->unique();

            // PERSONAL DATA
            $table->string('full_name');

            $table->enum('gender', ['L', 'P'])->nullable();

            $table->string('birth_place')->nullable();

            $table->date('birth_date')->nullable();

            $table->string('hobby')->nullable();

            $table->string('phone')->nullable();

            $table->text('address')->nullable();

            // FAMILY DATA
            $table->string('father_name')->nullable();

            $table->string('mother_name')->nullable();

            $table->string('parent_phone')->nullable();

            // PHOTO
            $table->string('photo')->nullable();

            // STATUS
            $table->enum('status', [
                'active',
                'inactive',
                'graduated',
                'transfer',
                'dropout'
            ])->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};