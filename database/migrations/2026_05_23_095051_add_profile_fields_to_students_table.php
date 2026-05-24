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
        Schema::table('students', function (Blueprint $table) {
            // Pribadi
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->text('address_origin')->nullable();
            $table->text('address_domicile')->nullable();
            $table->string('region')->nullable();
            $table->string('phone')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('previous_education')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('insurance')->nullable();
            
            // Akademik
            $table->string('program_study')->nullable();
            $table->string('department')->nullable();
            $table->string('education_level')->nullable();
            $table->string('entry_path')->nullable();
            $table->string('registration_status')->nullable();
            $table->string('photo')->nullable();
            
            // Keluarga
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('parent_job')->nullable();
            $table->string('parent_phone')->nullable();
            
            // Keuangan & Akademik Tambahan
            $table->boolean('is_kip_kuliah')->default(false);
            $table->text('gpa_history')->nullable(); // stored as JSON array
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'religion', 'gender', 'address_origin', 'address_domicile', 'region', 'phone',
                'nik', 'no_kk', 'previous_education', 'marital_status', 'insurance',
                'program_study', 'department', 'education_level', 'entry_path', 'registration_status', 'photo',
                'father_name', 'mother_name', 'parent_job', 'parent_phone',
                'is_kip_kuliah', 'gpa_history'
            ]);
        });
    }
};
