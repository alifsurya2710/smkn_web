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
            $table->string('title')->nullable()->after('name');
            $table->string('nip')->nullable()->unique()->after('email');
            $table->string('position')->nullable()->after('nip');
            $table->string('subject')->nullable()->after('position');
            $table->string('photo')->nullable()->after('password');
            $table->boolean('is_management')->default(false)->after('photo');
            $table->integer('order')->default(0)->after('is_management');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['title', 'nip', 'position', 'subject', 'photo', 'is_management', 'order']);
        });
    }
};
