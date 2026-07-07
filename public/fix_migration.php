<?php
$root = dirname(__DIR__);
$autoload = $root . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

echo "PROBING FOR AUTOLOAD AT: $autoload\n";

if (!file_exists($autoload)) {
    die("Error: Autoload not found at $autoload");
}

require $autoload;

$appPath = $root . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'app.php';
$app = require_once $appPath;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;

header('Content-Type: text/plain');

try {
    echo "Root: $root\n";
    echo "Menjalankan migrasi...\n";
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output();
    echo "\n=== SELESAI ===\n";
} catch (\Exception $e) {
    echo "Error:\n" . $e->getMessage();
}
