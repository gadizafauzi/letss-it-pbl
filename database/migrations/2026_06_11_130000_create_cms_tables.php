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
        // 1. cms_settings
        Schema::create('cms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
        });

        // 2. cms_hero_sections
        Schema::create('cms_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page')->unique();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('button_secondary_text')->nullable();
            $table->string('button_secondary_link')->nullable();
            $table->string('badge_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. cms_welcome_messages
        Schema::create('cms_welcome_messages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('greeting');
            $table->json('paragraphs');
            $table->string('kepsek_name');
            $table->string('kepsek_title');
            $table->string('kepsek_photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. cms_visi
        Schema::create('cms_visi', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. cms_misi_items
        Schema::create('cms_misi_items', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 6. cms_marquee_items
        Schema::create('cms_marquee_items', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 7. cms_statistics
        Schema::create('cms_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('number')->nullable();
            $table->string('suffix')->nullable();
            $table->string('label');
            $table->boolean('is_dynamic')->default(false);
            $table->string('dynamic_source')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 8. cms_programs
        Schema::create('cms_programs', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('title');
            $table->text('description');
            $table->string('detail')->nullable();
            $table->enum('category', ['keislaman', 'akademik', 'karakter'])->default('keislaman');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 9. cms_keunggulan
        Schema::create('cms_keunggulan', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('bg_color')->default('emerald');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 10. cms_testimonials
        Schema::create('cms_testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('name');
            $table->string('role');
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 11. cms_faqs
        Schema::create('cms_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->enum('page', ['home', 'ppdb', 'general'])->default('general');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 12. cms_sejarah_items
        Schema::create('cms_sejarah_items', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 13. cms_unit_details
        Schema::create('cms_unit_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->unique()->constrained('units')->cascadeOnDelete();
            $table->string('description_title')->nullable();
            $table->text('description_body')->nullable();
            $table->string('description_logo')->nullable();
            $table->string('target_age')->nullable();
            $table->string('quota')->nullable();
            $table->timestamps();
        });

        // 14. cms_unit_teachers
        Schema::create('cms_unit_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('jabatan')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['unit_id', 'teacher_id']);
        });

        // 15. cms_unit_ekskul
        Schema::create('cms_unit_ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->string('icon');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 16. cms_unit_facilities
        Schema::create('cms_unit_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->string('icon');
            $table->string('title');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 17. cms_achievements
        Schema::create('cms_achievements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['school', 'unit', 'teacher', 'student'])->default('school');
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->nullOnDelete();
            $table->foreignId('student_id')->nullable()->constrained('students')->nullOnDelete();
            $table->string('year');
            $table->string('title');
            $table->text('description');
            $table->string('level')->default('Kabupaten');
            $table->enum('side', ['left', 'right'])->default('left');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 18. cms_post_categories
        Schema::create('cms_post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('color')->default('emerald');
            $table->timestamps();
        });

        // 19. cms_posts
        Schema::create('cms_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('cms_post_categories')->restrictOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('body');
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->integer('views_count')->default(0);
            $table->dateTime('publish_date')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 20. cms_ppdb_timeline
        Schema::create('cms_ppdb_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('date_range');
            $table->enum('status', ['Dibuka', 'Segera', 'Menunggu', 'Selesai'])->default('Menunggu');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 21. cms_ppdb_requirements
        Schema::create('cms_ppdb_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->text('text');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 22. cms_ppdb_brochures
        Schema::create('cms_ppdb_brochures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 23. cms_ppdb_steps
        Schema::create('cms_ppdb_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number');
            $table->string('icon');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_ppdb_steps');
        Schema::dropIfExists('cms_ppdb_brochures');
        Schema::dropIfExists('cms_ppdb_requirements');
        Schema::dropIfExists('cms_ppdb_timeline');
        Schema::dropIfExists('cms_posts');
        Schema::dropIfExists('cms_post_categories');
        Schema::dropIfExists('cms_achievements');
        Schema::dropIfExists('cms_unit_facilities');
        Schema::dropIfExists('cms_unit_ekskul');
        Schema::dropIfExists('cms_unit_teachers');
        Schema::dropIfExists('cms_unit_details');
        Schema::dropIfExists('cms_sejarah_items');
        Schema::dropIfExists('cms_faqs');
        Schema::dropIfExists('cms_testimonials');
        Schema::dropIfExists('cms_keunggulan');
        Schema::dropIfExists('cms_programs');
        Schema::dropIfExists('cms_statistics');
        Schema::dropIfExists('cms_marquee_items');
        Schema::dropIfExists('cms_misi_items');
        Schema::dropIfExists('cms_visi');
        Schema::dropIfExists('cms_welcome_messages');
        Schema::dropIfExists('cms_hero_sections');
        Schema::dropIfExists('cms_settings');
    }
};
