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
            $table->string('highlight_title')->nullable()->after('career_opportunities');
            $table->text('highlight_description')->nullable()->after('highlight_title');
            $table->string('highlight_icon')->nullable()->after('highlight_description');
            $table->string('secondary_color')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn(['highlight_title', 'highlight_description', 'highlight_icon', 'secondary_color']);
        });
    }
};
