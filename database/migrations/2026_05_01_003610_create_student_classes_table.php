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
        Schema::create('student_classes', function (Blueprint $table) {

            $table->id();

            /**
             * SISWA
             */
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            /**
             * KELAS
             */
            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            /**
             * TAHUN AJARAN
             */
            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->cascadeOnDelete();

            $table->timestamps();

            /**
             * UNIQUE
             * siswa tidak boleh
             * punya 2 kelas
             * di tahun ajaran sama
             */
            $table->unique([
                'student_id',
                'academic_year_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_classes');
    }
};
