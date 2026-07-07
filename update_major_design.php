<?php

use App\Models\Major;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rpl = Major::where('slug', 'rekayasa-perangkat-lunak')->first();
if ($rpl) {
    $rpl->update([
        'highlight_title' => 'Fullstack Focus',
        'highlight_description' => 'Frontend, Backend, and Database engineering with modern frameworks.',
        'highlight_icon' => 'code',
        'secondary_color' => 'bg-blue-50',
    ]);
}

$tkr = Major::where('slug', 'teknik-kendaraan-ringan')->first();
if ($tkr) {
    $tkr->update([
        'highlight_title' => 'Advanced Mechanics',
        'highlight_description' => 'Modern engine diagnostics and advanced electrical systems expertise.',
        'highlight_icon' => 'settings',
        'secondary_color' => 'bg-yellow-50',
        'tagline' => 'Memberdayakan generasi muda di bidang otomotif melalui pembelajaran praktik langsung, penerapan standar industri terkini, serta penguasaan teknologi dan sistem kendaraan modern.',
        'detailed_description' => 'Jurusan Otomotif adalah jurusan unggulan yang berfokus pada teknologi, perawatan, dan perbaikan kendaraan bermotor modern.',
        'curriculum' => [
            '1. Dasar-dasar Otomotif',
            '2. Penerapan budaya kerja industri',
            '3. Tune Up Engine',
            '4. Perawatan Berkala',
            '5. Perawatan sistem sasis',
            '6. Perawatan sistem kelistrikan'
        ],
        'career_opportunities' => [
            '1. Mekanik',
            '2. Operator Manufacture',
            '3. Service Advisor',
            '4. Marketing',
            '5. Wirausaha'
        ],
        'gallery' => [
            'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517524008436-bbdb5395303c?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1544274411-a7af6d1211ff?q=80&w=600&auto=format&fit=crop'
        ],
    ]);
}

echo "Major design data updated successfully!\n";
