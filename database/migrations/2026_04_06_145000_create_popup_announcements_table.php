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
        Schema::create('popup_announcements', function (Blueprint $row) {
            $row->id();
            $row->string('title')->nullable();
            $row->string('image');
            $row->string('link')->nullable();
            $row->date('start_date');
            $row->date('end_date');
            $row->boolean('is_active')->default(true);
            $row->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popup_announcements');
    }
};
