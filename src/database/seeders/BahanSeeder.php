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
        ];

        foreach ($bahans as $bahan) {
            Bahan::create($bahan);
        }
    }
}