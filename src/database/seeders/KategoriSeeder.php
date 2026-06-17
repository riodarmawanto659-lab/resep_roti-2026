<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Roti Manis', 'deskripsi' => 'Roti lembut dengan isian atau topping manis.'],
            ['nama' => 'Roti Tawar', 'deskripsi' => 'Roti harian untuk sandwich, toast, dan sarapan.'],
            ['nama' => 'Donat', 'deskripsi' => 'Adonan goreng atau panggang dengan topping kreatif.'],
            ['nama' => 'Pastry', 'deskripsi' => 'Olahan berlapis dengan tekstur renyah dan buttery.'],
            ['nama' => 'Roti Gurih', 'deskripsi' => 'Roti dengan isian asin seperti keju, sosis, dan abon.'],
        ];

        foreach ($kategori as $item) {
            Kategori::updateOrCreate(
                ['slug' => Str::slug($item['nama'])],
                $item + ['slug' => Str::slug($item['nama'])]
            );
        }
    }
}
