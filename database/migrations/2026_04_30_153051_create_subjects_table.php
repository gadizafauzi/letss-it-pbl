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
        Schema::create('subjects', function (Blueprint $table) {

            $table->id();

            /**
             * UNIT
             * SD / SMP
             */
            $table->foreignId('unit_id')
                ->constrained('units')
                ->cascadeOnDelete();

            /**
             * KODE MAPEL
             * contoh:
             * MPL001
             */
            $table->string('subject_code')
                ->unique();

            /**
             * NAMA MAPEL
             */
            $table->string('subject_name');

            $table->timestamps();

            /**
             * UNIQUE
             * nama mapel tidak boleh sama
             * dalam 1 unit
             */
            $table->unique([
                'unit_id',
                'subject_name'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
