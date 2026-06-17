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
        $details = [
            'Roti Sobek Cokelat' => [
                'Tepung Terigu Protein Tinggi' => '500',
                'Gula Pasir' => '80',
                'Ragi Instan' => '7',
                'Susu Cair' => '220',
                'Telur' => '1',
                'Mentega' => '60',
                'Garam' => '5',
                'Cokelat Batang' => '120',
            ],
            'Donat Kentang Lembut' => [
                'Tepung Terigu Protein Tinggi' => '400',
                'Kentang Kukus' => '150',
                'Gula Pasir' => '70',
                'Ragi Instan' => '7',
                'Susu Cair' => '120',
                'Telur' => '1',
                'Mentega' => '50',
                'Garam' => '4',
            ],
            'Roti Tawar Susu' => [
                'Tepung Terigu Protein Tinggi' => '520',
                'Gula Pasir' => '55',
                'Ragi Instan' => '7',
                'Susu Cair' => '280',
                'Mentega' => '55',
                'Garam' => '6',
            ],
            'Roti Keju Gurih' => [
                'Tepung Terigu Protein Tinggi' => '450',
                'Gula Pasir' => '45',
                'Ragi Instan' => '7',
                'Susu Cair' => '190',
                'Telur' => '1',
                'Mentega' => '50',
                'Garam' => '6',
                'Keju Parut' => '130',
            ],
            'Pastry Cokelat Mini' => [
                'Cokelat Batang' => '160',
                'Telur' => '1',
            ],
            'Roti Mix Karamel' => [
                'Tepung Terigu Protein Tinggi' => '480',
                'Gula Pasir' => '90',
                'Ragi Instan' => '7',
                'Susu Cair' => '210',
                'Telur' => '1',
                'Mentega' => '65',
                'Garam' => '5',
            ],
        ];

        foreach ($details as $resepName => $ingredients) {
            $resep = Resep::where('nama', $resepName)->first();

            if (! $resep) {
                continue;
            }

            foreach ($ingredients as $bahanName => $jumlah) {
                $bahan = Bahan::where('nama', $bahanName)->first();

                if (! $bahan) {
                    continue;
                }

                DetailResep::updateOrCreate(
                    ['resep_id' => $resep->id, 'bahan_id' => $bahan->id],
                    ['jumlah' => $jumlah]
                );
            }
        }
    }
}
