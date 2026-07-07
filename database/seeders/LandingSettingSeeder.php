<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class LandingSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Hero Section
            ['key' => 'landing_hero_title', 'value' => 'SMK BISA, SMK HEBAT, SMK JUARA', 'type' => 'text', 'group' => 'landing'],
            ['key' => 'landing_hero_description', 'value' => 'Membentuk generasi yang kompeten dan berkarakter, yang siap bersaing di kancah industri global melalui pendidikan vokasi terdepan.', 'type' => 'text', 'group' => 'landing'],
            ['key' => 'landing_hero_image', 'value' => 'images/school-building.jpg', 'type' => 'image', 'group' => 'landing'],
            
            // Stats Section
            ['key' => 'stats_siswa_count', 'value' => '1800', 'type' => 'text', 'group' => 'landing'],
            ['key' => 'stats_pengajar_count', 'value' => '115', 'type' => 'text', 'group' => 'landing'],
            ['key' => 'stats_mitra_count', 'value' => '50', 'type' => 'text', 'group' => 'landing'],
            
            // Welcome Section
            ['key' => 'landing_welcome_title', 'value' => 'Sambutan Kepala Sekolah', 'type' => 'text', 'group' => 'landing'],
            ['key' => 'landing_welcome_quote', 'value' => 'Pendidikan adalah senjata paling ampuh untuk mengubah dunia.', 'type' => 'text', 'group' => 'landing'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
