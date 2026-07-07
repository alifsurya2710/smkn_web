<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    \Illuminate\Support\Facades\DB::statement('ALTER TABLE student_reports ADD jurusan VARCHAR(255) NULL AFTER nama');
    echo "Added 'jurusan' column to student_reports.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
