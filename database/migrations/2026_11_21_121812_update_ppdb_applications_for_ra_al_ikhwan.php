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
            // Drop foreign keys if they exist or make nullable
            if (Schema::hasColumn('ppdb_applications', 'first_choice_major_id')) {
                $table->dropForeign(['first_choice_major_id']);
                $table->unsignedBigInteger('first_choice_major_id')->nullable()->change();
            }
            if (Schema::hasColumn('ppdb_applications', 'second_choice_major_id')) {
                $table->dropForeign(['second_choice_major_id']);
                $table->unsignedBigInteger('second_choice_major_id')->nullable()->change();
            }

            // New fields for RA AL-IKHWAN
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->string('parent_name')->nullable()->after('full_name');
            $table->boolean('pernah_paud')->default(false)->after('phone');
            $table->string('foto_kk')->nullable()->after('pernah_paud');
            $table->string('foto_akta')->nullable()->after('foto_kk');
            $table->string('foto_rapot_paud')->nullable()->after('foto_akta');
            $table->string('bukti_transfer')->nullable()->after('foto_rapot_paud');
            $table->text('catatan')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_applications', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'parent_name',
                'pernah_paud',
                'foto_kk',
                'foto_akta',
                'foto_rapot_paud',
                'bukti_transfer',
                'catatan',
            ]);
        });
    }
};
