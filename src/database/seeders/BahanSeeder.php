<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        $bahans = [
            ['nama' => 'Tepung Terigu', 'satuan' => 'gram'],
            ['nama' => 'Gula Pasir', 'satuan' => 'gram'],
            ['nama' => 'Ragi Instan', 'satuan' => 'gram'],
            ['nama' => 'Mentega', 'satuan' => 'gram'],
            ['nama' => 'Susu Cair', 'satuan' => 'ml'],
            ['nama' => 'Telur', 'satuan' => 'butir'],
            ['nama' => 'Cokelat Meses', 'satuan' => 'gram'],
        ];

        foreach ($bahans as $bahan) {
            Bahan::create($bahan);
        }
    }
}