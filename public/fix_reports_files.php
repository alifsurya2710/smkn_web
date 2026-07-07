<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    \Illuminate\Support\Facades\Schema::table('student_reports', function($table) {
        if (!\Illuminate\Support\Facades\Schema::hasColumn('student_reports', 'file_path')) {
            $table->string('file_path')->nullable()->after('teacher_notes');
            echo "Added 'file_path' column.\n";
        }
        if (!\Illuminate\Support\Facades\Schema::hasColumn('student_reports', 'file_name')) {
            $table->string('file_name')->nullable()->after('file_path');
            echo "Added 'file_name' column.\n";
        }
    });
    echo "SUCCESS!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
