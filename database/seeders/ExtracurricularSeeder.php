<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Extracurricular;
use Illuminate\Support\Str;

class ExtracurricularSeeder extends Seeder
{
    public function run()
    {
        $ekskuls = [
            ['name' => 'Pramuka', 'description' => 'Pramuka SMKN 1 Katapang. Membentuk karakter, kemandirian, dan jiwa kepemimpinan.', 'image' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Bulutangkis', 'description' => 'Bulu Tangkis SMKN 1 Katapang. Melatih fokus, kelincahan, dan sportivitas.', 'image' => 'https://images.unsplash.com/photo-1599586120429-48281b6f0ece?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'PMR', 'description' => 'PMR SMKN 1 Katapang. Menumbuhkan kepedulian, kesiapsiagaan, dan jiwa kemanusiaan.', 'image' => 'https://images.unsplash.com/photo-1505751172107-1678144214e1?q=80&w=1000', 'category' => 'Arts & Culture'],
            ['name' => 'Lisska', 'description' => 'LISSKA SMKN 1 Katapang. Mengembangkan kepemimpinan dan karakter siswa dalam kegiatan organisasi.', 'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Inggris Club', 'description' => 'English Club SMKN 1 Katapang. Meningkatkan kemampuan berbahasa Inggris dan kepercayaan diri.', 'image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Japan Club', 'description' => 'Japan Club SMKN 1 Katapang. Mengembangkan minat bahasa dan budaya Jepang secara kreatif.', 'image' => 'https://images.unsplash.com/photo-1528154291023-a6525fabe5b4?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Ikatan Pelajar Masjid', 'description' => 'Ikatan Pemuda Masjid SMKN 1 Katapang. Menumbuhkan keimanan, kepemimpinan, dan kepedulian sosial.', 'image' => 'https://images.unsplash.com/photo-1593006526972-73a4b6c89791?q=80&w=1000', 'category' => 'Religious'],
            ['name' => 'Prisai Diri', 'description' => 'Perisai Diri SMKN 1 Katapang. Membentuk disiplin, ketahanan, dan pengendalian diri melalui bela diri.', 'image' => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'Futsal', 'description' => 'Futsal SMKN 1 Katapang. Mengembangkan kerja sama tim, strategi, dan semangat sportivitas.', 'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'Paku Bara', 'description' => 'Paskibra SMKN 1 Katapang. Unggul dalam disiplin dan kepemimpinan melalui upacara bendera.', 'image' => 'https://images.unsplash.com/photo-1533227268428-f9ed0900fb3b?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Basket', 'description' => 'Basket SMKN 1 Katapang. Melatih kekompakan, ketangkasan, dan jiwa kompetitif.', 'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'Voly', 'description' => 'Voli SMKN 1 Katapang. Membangun koordinasi, kerja sama, dan semangat berprestasi.', 'image' => 'https://images.unsplash.com/photo-1592656094267-764a45160876?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'KIR', 'description' => 'KIR SMKN 1 Katapang. Mengembangkan kreativitas, penelitian, dan inovasi siswa.', 'image' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?q=80&w=1000', 'category' => 'Academic'],
            ['name' => 'Tae Kwon Do', 'description' => 'Taekwondo SMKN 1 Katapang. Mengembangkan karakter, kekuatan, dan sportivitas.', 'image' => 'https://images.unsplash.com/photo-1552072092-2f9b1321e417?q=80&w=1000', 'category' => 'Sports'],
            ['name' => 'Drumband', 'description' => 'Drumband SMKN 1 Katapang. Mengembangkan kekompakan, disiplin, dan kreativitas dalam seni musik baris-berbaris.', 'image' => 'https://images.unsplash.com/photo-1501612722273-ed8486026859?q=80&w=1000', 'category' => 'Arts & Culture'],
        ];

        foreach ($ekskuls as $index => $ekskul) {
            Extracurricular::updateOrCreate(
                ['slug' => Str::slug($ekskul['name'])],
                array_merge($ekskul, ['order' => $index, 'is_active' => true])
            );
        }
    }
}
