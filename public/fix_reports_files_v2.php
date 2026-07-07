<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE student_reports ADD file_path VARCHAR(255) NULL AFTER teacher_notes');
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE student_reports ADD file_name VARCHAR(255) NULL AFTER file_path');
    echo "Added 'file_path' and 'file_name' columns via RAW SQL.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
