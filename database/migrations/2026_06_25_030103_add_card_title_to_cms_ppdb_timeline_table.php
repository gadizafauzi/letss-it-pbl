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
        Schema::table('cms_ppdb_timeline', function (Blueprint $table) {
            $table->string('card_title')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms_ppdb_timeline', function (Blueprint $table) {
            $table->dropColumn('card_title');
        });
    }
};
