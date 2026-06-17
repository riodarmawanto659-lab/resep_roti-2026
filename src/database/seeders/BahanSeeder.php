<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        $bahans = [
            ['nama' => 'Tepung Terigu Protein Tinggi', 'satuan' => 'gram'],
            ['nama' => 'Gula Pasir', 'satuan' => 'gram'],
            ['nama' => 'Ragi Instan', 'satuan' => 'gram'],
            ['nama' => 'Susu Cair', 'satuan' => 'ml'],
            ['nama' => 'Telur', 'satuan' => 'butir'],
            ['nama' => 'Mentega', 'satuan' => 'gram'],
            ['nama' => 'Garam', 'satuan' => 'gram'],
            ['nama' => 'Cokelat Batang', 'satuan' => 'gram'],
            ['nama' => 'Keju Parut', 'satuan' => 'gram'],
            ['nama' => 'Kentang Kukus', 'satuan' => 'gram'],
            ['nama' => 'Air Dingin', 'satuan' => 'ml'],
        ];

        foreach ($bahans as $bahan) {
            Bahan::updateOrCreate(['nama' => $bahan['nama']], $bahan);
        }
    }
}
