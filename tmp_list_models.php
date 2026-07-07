<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;

$env = file_get_contents('.env');
preg_match('/GEMINI_API_KEY=(.*)/', $env, $matches);
$key = trim($matches[1] ?? '');

if (!$key) {
    echo "API Key not found\n";
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1/models?key=" . $key;
$response = Http::get($url);

if ($response->successful()) {
    $data = $response->json();
    foreach ($data['models'] as $m) {
        echo $m['name'] . "\n";
    }
} else {
    echo "ERROR: " . $response->status() . "\n" . $response->body() . "\n";
}
