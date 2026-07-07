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
        // Add fields to majors
        Schema::table('majors', function (Blueprint $table) {
            if (!Schema::hasColumn('majors', 'image')) {
                $table->string('image')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('majors', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('gallery');
            }
            if (!Schema::hasColumn('majors', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
            if (!Schema::hasColumn('majors', 'order')) {
                $table->integer('order')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('majors', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Add fields to extracurriculars
        Schema::table('extracurriculars', function (Blueprint $table) {
            if (!Schema::hasColumn('extracurriculars', 'coach')) {
                $table->string('coach')->nullable()->after('mentor');
            }
            if (!Schema::hasColumn('extracurriculars', 'schedule')) {
                $table->string('schedule')->nullable()->after('coach');
            }
            if (!Schema::hasColumn('extracurriculars', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('schedule');
            }
            if (!Schema::hasColumn('extracurriculars', 'order')) {
                $table->integer('order')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('extracurriculars', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Add fields to achievements
        Schema::table('achievements', function (Blueprint $table) {
            if (!Schema::hasColumn('achievements', 'year')) {
                $table->string('year')->nullable()->after('date');
            }
            if (!Schema::hasColumn('achievements', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('year');
            }
            if (!Schema::hasColumn('achievements', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Add fields to facilities
        Schema::table('facilities', function (Blueprint $table) {
            if (!Schema::hasColumn('facilities', 'icon')) {
                $table->string('icon')->nullable()->after('image');
            }
            if (!Schema::hasColumn('facilities', 'order')) {
                $table->integer('order')->default(0)->after('icon');
            }
            if (!Schema::hasColumn('facilities', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
            if (!Schema::hasColumn('facilities', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn(['image', 'is_featured', 'is_active', 'order']);
            $table->dropSoftDeletes();
        });
        // ... other tables can be handled if needed, usually we don't drop on common migrations unless necessary
    }
};
