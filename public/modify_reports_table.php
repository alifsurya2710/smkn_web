<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

echo "MODIFYING student_reports TABLE:\n";

try {
    \Illuminate\Support\Facades\Schema::table('student_reports', function($table) {
        if (!\Illuminate\Support\Facades\Schema::hasColumn('student_reports', 'nisn')) {
            $table->string('nisn')->nullable()->after('student_id');
            echo "Added 'nisn' column.\n";
        }
        if (!\Illuminate\Support\Facades\Schema::hasColumn('student_reports', 'nama')) {
            $table->string('nama')->nullable()->after('nisn');
            echo "Added 'nama' column.\n";
        }
        // Make student_id nullable
        $table->unsignedBigInteger('student_id')->nullable()->change();
        echo "Made 'student_id' nullable.\n";
    });
    echo "SUCCESS!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
