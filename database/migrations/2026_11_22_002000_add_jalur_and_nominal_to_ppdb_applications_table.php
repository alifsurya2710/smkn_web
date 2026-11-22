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
        Schema::table('ppdb_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('ppdb_applications', 'jalur_pendaftaran')) {
                $table->string('jalur_pendaftaran')->default('reguler')->after('nisn');
            }
            if (!Schema::hasColumn('ppdb_applications', 'nominal_biaya')) {
                $table->unsignedBigInteger('nominal_biaya')->default(150000)->after('jalur_pendaftaran');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn(['jalur_pendaftaran', 'nominal_biaya']);
        });
    }
};
