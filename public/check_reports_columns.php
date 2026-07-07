<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

echo "CHECKING student_reports COLUMNS:\n";

try {
    $columns = \Illuminate\Support\Facades\Schema::getColumnListing('student_reports');
    foreach ($columns as $column) {
        echo "- " . $column . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
