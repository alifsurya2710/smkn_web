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
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            // About Section
            $table->string('about_hero_title')->nullable();
            $table->text('about_hero_description')->nullable();
            
            // Vision & Mission
            $table->text('vision')->nullable();
            $table->json('mission')->nullable();
            
            // Principal Section
            $table->string('principal_name')->nullable();
            $table->string('principal_title')->nullable();
            $table->text('principal_message')->nullable();
            $table->string('principal_photo')->nullable();
            
            // Other data
            $table->json('history')->nullable();
            $table->json('stats')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
