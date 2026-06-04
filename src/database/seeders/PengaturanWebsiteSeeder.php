<?php

namespace Database\Seeders;

use App\Models\PengaturanWebsite;
use Illuminate\Database\Seeder;

class PengaturanWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        PengaturanWebsite::create([
            'nama_website' => 'Sistem Resep Roti',
            'logo' => null,
            'judul_hero' => 'Kumpulan Resep Roti Terbaik',
            'subjudul_hero' => 'Temukan berbagai resep roti lezat dan mudah dibuat di rumah.',
            'gambar_hero' => null,
            'tentang_kami' => 'Website yang menyediakan berbagai resep roti lengkap dan mudah dipahami.',
            'email' => 'admin@reseproti.com',
            'telepon' => '081234567890',
            'alamat' => 'Indonesia',
        ]);
    }
}