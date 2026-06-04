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
            'Roti Manis',
            'Roti Tawar',
            'Donat',
            'Pastry',
        ];

        foreach ($kategori as $item) {
            Kategori::create([
                'nama' => $item,
                'slug' => Str::slug($item),
                'deskripsi' => "Kategori {$item}",
            ]);
        }
    }
}