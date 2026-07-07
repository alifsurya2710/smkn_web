<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$image = \App\Models\Setting::get('major_hero_image');
$title = \App\Models\Setting::get('major_hero_title');

echo "IMAGE: " . ($image ?: 'NULL') . "\n";
echo "TITLE: " . ($title ?: 'NULL') . "\n";
