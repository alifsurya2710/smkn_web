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
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->string('about_title')->nullable()->after('description');
            $table->text('about_description')->nullable()->after('about_title');
            $table->string('about_image')->nullable()->after('about_description');
            $table->text('footer_description')->nullable()->after('about_image');
            $table->json('social_links')->nullable()->after('footer_description');
        });

        Schema::table('achievements', function (Blueprint $table) {
            $table->foreignId('extracurricular_id')->nullable()->constrained()->onDelete('set null')->after('category_id');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreignId('extracurricular_id')->nullable()->constrained()->onDelete('set null')->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign(['extracurricular_id']);
            $table->dropColumn('extracurricular_id');
        });

        Schema::table('achievements', function (Blueprint $table) {
            $table->dropForeign(['extracurricular_id']);
            $table->dropColumn('extracurricular_id');
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->dropColumn(['about_title', 'about_description', 'about_image', 'footer_description', 'social_links']);
        });
    }
};
