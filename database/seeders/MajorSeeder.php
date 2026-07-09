<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'acronym' => 'RPL',
                'tagline' => 'Mempersiapkan generasi pengembang perangkat lunak dan inovator teknologi masa depan melalui pembelajaran praktis, standar industri, dan penguasaan teknologi modern.',
                'category' => 'TECHNOLOGY',
                'banner_text' => 'PENGEMBANGAN PERANGKAT LUNAK DAN GIM',
                'color' => 'bg-[#2F80ED]',
                'seats' => 72,
                'slug' => 'rekayasa-perangkat-lunak',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop',
                'description' => 'Program keahlian yang fokus pada pengembangan perangkat lunak, aplikasi web, dan mobile.',
                'detailed_description' => 'Rekayasa Perangkat Lunak (RPL) adalah jurusan unggulan di SMK yang berfokus pada arsitektur, perancangan, dan pengembangan sistem perangkat lunak. Kami menjembatani kesenjangan antara teori akademik dan realitas industri. Kurikulum kami dirancang secara menyeluruh untuk mencakup seluruh siklus pengembangan perangkat lunak—mulai dari analisis kebutuhan hingga tahap implementasi (deployment). Siswa menguasai berbagai bahasa pemrograman seperti Java, Python, dan JavaScript, sekaligus mendalami teknologi web modern, framework aplikasi mobile, serta sistem manajemen basis data yang andal.',
                'curriculum' => [
                    'Dasar-dasar Pengembangan Perangkat Lunak dan Gim',
                    'Basis data meliputi struktur, hirarki, aturan, komponen, instalasi, dan administrasi basis data',
                    'Pemrograman terstruktur, pemrograman berorientasi objek, dasar pemodelan perangkat lunak, dan pemrograman antar muka grafis',
                    'Pemrograman web statis dan dinamis',
                    'Integrated Development Environment, framework, pemrograman perangkat bergerak serta antarmuka aplikasi'
                ],
                'career_opportunities' => [
                    'Programmer',
                    'System Analyst',
                    'Database Administrator',
                    'Web Developer',
                    'Konsultan IT',
                    'IT Support'
                ],
                'gallery' => [
                    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1504639725590-34d0984388bd?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=600&auto=format&fit=crop'
                ],
                'is_active' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Teknik Kendaraan Ringan',
                'acronym' => 'TKR',
                'tagline' => 'Memberdayakan generasi muda di bidang otomotif melalui pembelajaran praktik langsung, penerapan standar industri terkini, serta penguasaan teknologi dan sistem kendaraan modern untuk mencetak tenaga profesional yang kompeten dan siap bersaing di dunia kerja.',
                'category' => 'AUTOMOTIVE',
                'banner_text' => 'TEKNIK OTOMOTIF',
                'color' => 'bg-[#f97316]',
                'seats' => 96,
                'slug' => 'teknik-kendaraan-ringan',
                'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=2070&auto=format&fit=crop',
                'description' => 'Pelajari keahlian yang paling dibutuhkan di era otomasi industri dan teknologi kendaraan modern saat ini.',
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
                'is_active' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'Desain Komunikasi Visual',
                'acronym' => 'DKV',
                'category' => 'CREATIVE ARTS',
                'tagline' => 'Mengembangkan kreativitas visual melalui desain grafis, produksi video, dan fotografi digital untuk bersaing di industri kreatif modern.',
                'description' => 'Fokus pada desain grafis, produksi video, dan fotografi digital untuk berkembang di industri kreatif.',
                'detailed_description' => 'Desain Komunikasi Visual (DKV) adalah program keahlian yang mempelajari seni komunikasi menggunakan bahasa visual. Siswa diajarkan konsep kreatif, desain grafis, ilustrasi, fotografi, videografi, animasi, serta strategi komunikasi merek di media digital maupun cetak.',
                'banner_text' => 'BROADCASTING DAN PERFILMAN',
                'color' => 'bg-[#4F5B6F]',
                'seats' => 72,
                'slug' => 'multimedia',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=600&auto=format&fit=crop',
                'order' => 3,
            ],
            [
                'name' => 'Teknik Komputer & Jaringan',
                'acronym' => 'TKJ',
                'category' => 'TECHNOLOGY',
                'tagline' => 'Pelatihan profesional dalam jaringan komputer, infrastruktur internet, keamanan siber, dan perakitan perangkat keras.',
                'description' => 'Pelatihan profesional dalam jaringan komputer, infrastruktur, keamanan siber, dan perakitan perangkat keras.',
                'detailed_description' => 'Teknik Komputer & Jaringan (TKJ) membekali siswa dengan keahlian praktis dalam membangun, mengonfigurasi, dan merawat infrastruktur jaringan komputer. Kurikulum mencakup routing, switching, instalasi server Linux/Windows, keamanan jaringan, serta troubleshooting perangkat keras.',
                'banner_text' => 'TEKNIK JARINGAN KOMPUTER DAN TELEKOMUNIKASI',
                'color' => 'bg-[#2F80ED]',
                'seats' => 108,
                'slug' => 'teknik-komputer-jaringan',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010ccdcc51?q=80&w=600&auto=format&fit=crop',
                'order' => 4,
            ],
            [
                'name' => 'Teknik Elektronika Industri',
                'acronym' => 'TEI',
                'category' => 'ELECTRICAL',
                'tagline' => 'Kurikulum kelistrikan komprehensif meliputi sistem sirkuit elektronik, mikrokontroler, dan otomatisasi industri.',
                'description' => 'Kurikulum kelistrikan komprehensif meliputi sistem sirkuit, dasar elektronika, dan otomatisasi industri.',
                'detailed_description' => 'Teknik Elektronika Industri (TEI) mempersiapkan siswa menjadi ahli dalam merancang, merawat, dan mengoperasikan sistem kontrol elektronik industri. Fokus pembelajaran mencakup pemrograman PLC, mikrokontroler, robotika, instrumentasi, dan pemeliharaan mesin industri otomatis.',
                'banner_text' => 'TEKNIK ELEKTRONIKA',
                'color' => 'bg-[#F2C94C]',
                'seats' => 144,
                'slug' => 'teknik-elektronika-industri',
                'image' => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?q=80&w=600&auto=format&fit=crop',
                'order' => 5,
            ],
            [
                'name' => 'Teknik Pemesinan',
                'acronym' => 'MP',
                'category' => 'MECHANICAL',
                'tagline' => 'Membentuk tenaga kerja profesional dan kompeten di bidang manufaktur dan teknologi pemesinan presisi.',
                'description' => 'Kurikulum teknik pemesinan yang mencakup teknologi manufaktur, mesin perkakas, dan teknologi pemesinan CNC.',
                'detailed_description' => 'Teknik Pemesinan (MP) adalah program keahlian yang membekali siswa dengan keterampilan pengolahan logam dan pembuatan komponen mesin menggunakan mesin perkakas konvensional maupun CNC (Computer Numerical Control).',
                'banner_text' => 'TEKNIK PEMESINAN',
                'color' => 'bg-[#ef4444]',
                'seats' => 123,
                'slug' => 'teknik-pemesinan',
                'image' => 'https://images.unsplash.com/photo-1537462715879-360eeb61a0ad?q=80&w=600&auto=format&fit=crop',
                'order' => 6,
            ],
            [
                'name' => 'TEKNIK TEKSTIL',
                'acronym' => 'TEKSTIL',
                'category' => 'TEXTILE',
                'tagline' => 'Mempersiapkan tenaga terampil teknologi pengolahan serat, benang, pewarnaan, dan produksi kain modern.',
                'description' => 'Kurikulum Teknik Tekstil yang mencakup teknologi pengolahan bahan tekstil, produksi kain, dan desain.',
                'detailed_description' => 'Teknik Tekstil mendidik siswa tentang seluruh rangkaian industri pembuatan kain, mulai dari pengolahan serat benang, teknik pertenunan, proses penyempurnaan kain (finishing), hingga pewarnaan tekstil menggunakan instrumen teknologi modern.',
                'banner_text' => 'TEKNIK TEKSTIL',
                'color' => 'bg-[#22c55e]',
                'seats' => 120,
                'slug' => 'teknik-tekstil',
                'image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?q=80&w=600&auto=format&fit=crop',
                'order' => 7,
            ],
        ];

        foreach ($majors as $major) {
            \App\Models\Major::updateOrCreate(['slug' => $major['slug']], $major);
        }
    }
}
