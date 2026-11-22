<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;
use Illuminate\Support\Facades\DB;

class KelasRaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = [
            [
                'name' => 'Kelas Kober',
                'acronym' => 'KOBER',
                'tagline' => 'Kelompok Bermain (Kober) - Pengenalan Karakter & Motorik Dini Islami',
                'category' => 'RAUDHATUL ATHFAL',
                'banner_text' => 'KELAS KOBER (KELOMPOK BERMAIN)',
                'color' => 'bg-emerald-600',
                'seats' => 30,
                'slug' => 'kelas-kober',
                'description' => 'Kelompok Bermain (Kober) untuk stimulasi perkembangan usia dini, motorik halus dan kasar, serta sosialisasi bermain.',
                'detailed_description' => 'Kelas Kober difokuskan pada pengenalan nilai-nilai keislaman dasar, doa harian sederhana, dan stimulasi tumbuh kembang anak usia dini dalam suasana bermain yang aman dan menyenangkan.',
                'curriculum' => [
                    'Pengenalan Huruf & Angka Dasar',
                    'Doa-doa Harian Sederhana',
                    'Pengembangan Motorik Kasar & Halus',
                    'Bermain Sensorik & Sosialisasi Anak'
                ],
                'career_opportunities' => [
                    'Kesiapan Masuk Kelompok RA',
                    'Kemandirian & Sosialisasi Dini'
                ],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Kelas Bulan',
                'acronym' => 'BULAN',
                'tagline' => 'Kelas Bulan - Menyinari Budi Pekerti & Karakter Mulia',
                'category' => 'RAUDHATUL ATHFAL',
                'banner_text' => 'KELAS BULAN',
                'color' => 'bg-blue-600',
                'seats' => 30,
                'slug' => 'kelas-bulan',
                'description' => 'Kelompok belajar Kelas Bulan untuk penanaman budi pekerti, nilai-nilai tauhid, dan adab Islami.',
                'detailed_description' => 'Kelas Bulan membimbing anak mengenal cinta Allah dan Rasul, hafalan surat-surat pendek, praktek adab harian, serta interaksi sosial yang santun dan hangat.',
                'curriculum' => [
                    'Pembiasaan Sholat & Wudhu',
                    'Hafalan Surat Pendek Juz 30',
                    'Kisah Teladan Nabi & Sahabat',
                    'Stimulasi Bahasa & Pra-Literasi'
                ],
                'career_opportunities' => [
                    'Karakter Islami Sejak Dini',
                    'Kemandirian Ibadah'
                ],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Kelas Matahari',
                'acronym' => 'MATAHARI',
                'tagline' => 'Kelas Matahari - Semangat Ceria & Eksplorasi Kreatif',
                'category' => 'RAUDHATUL ATHFAL',
                'banner_text' => 'KELAS MATAHARI',
                'color' => 'bg-amber-600',
                'seats' => 30,
                'slug' => 'kelas-matahari',
                'description' => 'Kelompok belajar Kelas Matahari untuk eksplorasi kreativitas, seni, sains sederhana, dan keaktifan anak.',
                'detailed_description' => 'Kelas Matahari memberikan ruang luas bagi anak untuk aktif bergerak, berimajinasi, bereksperimen sains sederhana, dan mengembangkan bakat seni.',
                'curriculum' => [
                    'Sains Sederhana & Eksplorasi Alam',
                    'Seni Mewarnai, Menggambar & Kerajinan',
                    'Gerak & Lagu Edukasi Islami',
                    'Kecakapan Berpikir Kritis Dasar'
                ],
                'career_opportunities' => [
                    'Kreativitas & Daya Cipta',
                    'Kepercayaan Diri Tinggi'
                ],
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Kelas Bintang',
                'acronym' => 'BINTANG',
                'tagline' => 'Kelas Bintang - Prestasi, Tahfidz & Kesiapan Sekolah Dasar',
                'category' => 'RAUDHATUL ATHFAL',
                'banner_text' => 'KELAS BINTANG',
                'color' => 'bg-purple-600',
                'seats' => 30,
                'slug' => 'kelas-bintang',
                'description' => 'Kelompok belajar Kelas Bintang untuk pematangan tahfidz, pra-literasi lanjutan, dan kesiapan masuk SD/MI.',
                'detailed_description' => 'Kelas Bintang mempersiapkan anak dengan percaya diri menuju jenjang SD/MI, dengan kemampuan calistung ramah anak, ketahanan mental, serta tahfidz quran yang kuat.',
                'curriculum' => [
                    'Pra-Literasi & Numerasi Mandiri',
                    'Tahfidz Al-Qur\'an Juz 30 Lanjutan',
                    'Pra-Calistung Terpadu Menyenangkan',
                    'Bahasa Arab & Inggris Sederhana'
                ],
                'career_opportunities' => [
                    'Kesiapan Penuh Jenjang SD/MI',
                    'Karakter Mandiri & Cinta Qur\'an'
                ],
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        // Disable foreign key checks to safely truncate and replace
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Major::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($kelasList as $kelas) {
            Major::create($kelas);
        }
    }
}
