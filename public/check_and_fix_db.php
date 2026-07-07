<?php
$root = dirname(__DIR__);
require $root . '/vendor/autoload.php';
$app = require_once $root . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

echo "DIAGNOSTIC TEST:\n";

try {
    $exists = \Illuminate\Support\Facades\Schema::hasTable('testimonis');
    echo "Table 'testimonis' exists? " . ($exists ? "YES" : "NO") . "\n";
    
    if (!$exists) {
        echo "Attempting to create table...\n";
        \Illuminate\Support\Facades\Schema::create('testimonis', function($table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('pesan');
            $table->integer('rating');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        echo "SUCCESS: Table created!\n";
    }
} catch (\Exception $e) {
    echo "CRITICAL ERROR: " . $e->getMessage() . "\n";
    echo "FILE: " . $e->getFile() . " ON LINE " . $e->getLine() . "\n";
}
