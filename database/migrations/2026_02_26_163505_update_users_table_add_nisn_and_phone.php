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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nisn')->unique()->nullable()->after('email');
            $table->string('no_telp')->nullable()->after('nisn');
            $table->foreignId('major_id')->nullable()->after('no_telp')->constrained('majors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropColumn(['nisn', 'no_telp', 'major_id']);
        });
    }
};
