<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\DetailResep;
use App\Models\Resep;
use Illuminate\Database\Seeder;

class DetailResepSeeder extends Seeder
{
    public function run(): void
    {
        $resep = Resep::where('nama', 'Roti Sobek Cokelat')->first();

        DetailResep::create([
            'resep_id' => $resep->id,
            'bahan_id' => Bahan::where('nama', 'Tepung Terigu')->first()->id,
            'jumlah' => '500 gram',
        ]);

        DetailResep::create([
            'resep_id' => $resep->id,
            'bahan_id' => Bahan::where('nama', 'Gula Pasir')->first()->id,
            'jumlah' => '100 gram',
        ]);

        DetailResep::create([
            'resep_id' => $resep->id,
            'bahan_id' => Bahan::where('nama', 'Ragi Instan')->first()->id,
            'jumlah' => '10 gram',
        ]);

        DetailResep::create([
            'resep_id' => $resep->id,
            'bahan_id' => Bahan::where('nama', 'Mentega')->first()->id,
            'jumlah' => '75 gram',
        ]);
    }
}