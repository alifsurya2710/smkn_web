<?php

use App\Models\Major;
use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tkr = Major::where('slug', 'teknik-kendaraan-ringan')->first();

if ($tkr) {
    $tkr->update([
        'tagline' => 'Memberdayakan generasi muda di bidang otomotif melalui pembelajaran praktik langsung, penerapan standar industri terkini, serta penguasaan teknologi dan sistem kendaraan modern untuk mencetak tenaga profesional yang kompeten dan siap bersaing di dunia kerja.',
        'detailed_description' => 'Jurusan Otomotif adalah jurusan unggulan di SMK yang berfokus pada teknologi, perawatan, dan perbaikan kendaraan bermotor. Kami membekali siswa dengan pengetahuan teori dan keterampilan praktik agar siap menghadapi kebutuhan dunia industri otomotif modern. Kurikulum kami dirancang secara menyeluruh untuk mencakup seluruh proses pembelajaran otomotif—mulai dari analisis kerusakan kendaraan hingga tahap perbaikan dan perawatan akhir. Siswa menguasai berbagai teknik dasar otomotif, seperti sistem mesin, kelistrikan kendaraan, hingga teknologi kendaraan modern, serta mendalami penggunaan alat diagnosa dan perawatan kendaraan yang sesuai dengan standar industri.',
        'curriculum' => [
            '1. Dasar-dasar Otomotif',
            '2. Penerapan budaya kerja industri',
            '3. Tune Up Engine',
            '4. Perawatan Berkala 10.000, 20.000 dan 40.000 KM',
            '5. Perawatan sistem sasis dan pemindah tenaga',
            '6. Perawatan sistem kelistrikan yang saling berhubungan dengan aplikasi lainnya (Application Programming Interface)'
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
    echo "TKR data updated successfully!\n";
} else {
    echo "TKR major not found.\n";
}
