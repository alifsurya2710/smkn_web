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
            $table->string('acronym')->nullable()->after('name');
            $table->string('category')->nullable()->after('acronym');
            $table->string('banner_text')->nullable()->after('category');
            $table->string('color')->nullable()->after('banner_text');
            $table->integer('seats')->default(0)->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn(['acronym', 'category', 'banner_text', 'color', 'seats']);
        });
    }
};
