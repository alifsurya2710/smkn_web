<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

try {
    $report = \App\Models\StudentReport::create([
        'nisn' => 'TEST1234',
        'nama' => 'TESTING',
        'semester' => 'Ganjil',
        'academic_year' => '2023/2024',
        'academic_year_id' => 1,
        'file_path' => 'test/path.pdf',
        'file_name' => 'test.pdf',
        'grades' => []
    ]);
    echo "SUCCESS: Report created ID " . $report->id . "\n";
    $report->delete(); // cleanup
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
