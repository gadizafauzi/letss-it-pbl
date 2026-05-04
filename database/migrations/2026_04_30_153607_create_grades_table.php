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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teaching_assignment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();

            $table->enum('semester', ['odd', 'even']);

            $table->decimal('assignment_score', 5, 2)->nullable();
            $table->decimal('mid_exam', 5, 2)->nullable();
            $table->decimal('final_exam', 5, 2)->nullable();
            $table->decimal('final_score', 5, 2)->nullable();
            $table->string('grade_letter')->nullable();

            // $table->enum('status', ['draft', 'published'])->default('draft');
            $table->enum('status', ['draft', 'published', 'final'])->default('draft');

            $table->unique(
                ['student_id', 'teaching_assignment_id', 'semester', 'academic_year_id'],
                'grades_unique'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
