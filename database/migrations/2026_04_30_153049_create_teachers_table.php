<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {

            $table->id();

            /**
             * RELASI USER
             */
            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            /**
             * RELASI UNIT
             */
            $table->foreignId('unit_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * RELASI JABATAN
             */
            $table->foreignId('position_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /**
             * IDENTITAS GURU
             */
            $table->string('nip')->unique();

            $table->string('full_name');

            /**
             * DATA PRIBADI
             */
            $table->enum('gender', ['male', 'female'])
                ->nullable();

            $table->string('birth_place')
                ->nullable();

            $table->date('birth_date')
                ->nullable();

            /**
             * DATA AKADEMIK
             */
            $table->string('last_education')
                ->nullable();

            /**
             * KONTAK
             */
            $table->string('phone')
                ->nullable();

            $table->text('address')
                ->nullable();

            /**
             * KEPEGAWAIAN
             */
            $table->string('employment_status')
                ->nullable();
            // PNS, PPPK, Honorer, GTY, dll

            /**
             * STATUS
             */
            $table->enum('status', ['active', 'inactive'])
                ->default('active');

            /**
             * FOTO
             */
            $table->string('photo')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
