<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add academic_year_id to student_reports
        Schema::table('student_reports', function (Blueprint $table) {
            $table->foreignId('academic_year_id')->nullable()->after('semester')->constrained('academic_years');
            $table->index('academic_year_id');
        });

        // Add academic_year_id to ppdb_applications
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->foreignId('academic_year_id')->nullable()->after('status')->constrained('academic_years');
            $table->index('academic_year_id');
            $table->index('nisn');
        });

        // Add indices to other tables as requested
        Schema::table('users', function (Blueprint $table) {
            $table->index('nisn');
            $table->index('major_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->index('slug');
        });

        Schema::table('majors', function (Blueprint $table) {
            $table->index('slug');
        });
        
        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::table('student_reports', function (Blueprint $table) {
            $table->dropForeign(['academic_year_id']);
            $table->dropColumn('academic_year_id');
        });

        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropForeign(['academic_year_id']);
            $table->dropColumn('academic_year_id');
            $table->dropIndex(['nisn']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['nisn']);
            $table->dropIndex(['major_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });

        Schema::table('majors', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->dropIndex(['slug']);
        });
    }
};
