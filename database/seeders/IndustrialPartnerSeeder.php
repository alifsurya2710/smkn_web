<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrialPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            'Pudak Scientific', 'INTI', 'PLN', 'Inovincia Digital', 'Inspira Academy', 'JIAEC',
            'Dahlia FM', 'MQTV', 'Astra Daihatsu Motor', 'LEN Industri', 'CGI Foundation', 'Hasakona Binacipta',
            'Qwords', 'iForte', 'Bukaka Teknik Utama', 'Indomobil Nissan Datsun', 'Telkom Indonesia', 'TVRI Jabar',
            'GMP', 'Pentacode', 'Musashi', 'Alfamart', 'Medion', 'Mitsubishi Motors',
            'Denso Indonesia', 'Ateja', 'Auto 2000', 'Danar Mas', 'DAMRI', 'Diskominfo Kab. Bandung',
            'Tirta Jabar', 'PT Central Texindo', 'PT Jinyoung', 'Kereta Api Indonesia', 'Panasonic', 'Astra Honda Motor'
        ];

        foreach ($partners as $index => $name) {
            \App\Models\IndustrialPartner::updateOrCreate(
                ['name' => $name],
                ['order' => $index, 'is_active' => true]
            );
        }
    }
}
