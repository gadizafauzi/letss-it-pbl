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
        Schema::rename('cms_keunggulan', 'cms_tujuan_pendidikan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('cms_tujuan_pendidikan', 'cms_keunggulan');
    }
};
