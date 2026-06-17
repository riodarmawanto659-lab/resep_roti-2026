<?php

namespace Database\Seeders;

use App\Models\PengaturanWebsite;
use Illuminate\Database\Seeder;

class PengaturanWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        PengaturanWebsite::updateOrCreate(
            ['nama_website' => 'Roti Mix'],
            [
                'logo' => null,
                'judul_hero' => 'Kumpulan Resep Roti Mix Terbaik',
                'subjudul_hero' => 'Temukan resep roti, bahan, takaran, dan langkah pembuatan dengan tampilan yang hangat dan modern.',
                'gambar_hero' => null,
                'tentang_kami' => 'Roti Mix adalah website manajemen resep roti yang membantu pengguna menyimpan resep, membaca bahan, memilih kategori, dan mengikuti langkah pembuatan secara rapi.',
                'email' => 'admin@rotimix.local',
                'telepon' => '0812-3456-7890',
                'alamat' => 'Indonesia',
            ]
        );
    }
}
