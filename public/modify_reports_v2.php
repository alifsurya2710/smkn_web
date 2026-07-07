<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    \Illuminate\Support\Facades\Schema::table('student_reports', function($table) {
        $table->string('nisn')->nullable()->after('student_id');
        $table->string('nama')->nullable()->after('nisn');
    });
    echo "Added 'nisn' and 'nama' columns.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
