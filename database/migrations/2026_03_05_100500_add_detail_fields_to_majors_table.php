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
        Schema::table('majors', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('name');
            $table->text('detailed_description')->nullable()->after('description');
            $table->json('curriculum')->nullable()->after('detailed_description');
            $table->json('career_opportunities')->nullable()->after('curriculum');
            $table->string('video_url')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'detailed_description', 'curriculum', 'career_opportunities', 'video_url']);
        });
    }
};
