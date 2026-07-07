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
            $table->string('about_image')->nullable()->after('image');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->after('author_id')->constrained()->nullOnDelete();
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->foreignId('major_id')->nullable()->after('extracurricular_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn('about_image');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropColumn('major_id');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropColumn('major_id');
        });
    }
};
