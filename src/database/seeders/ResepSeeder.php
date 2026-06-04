<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Resep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        Resep::create([
            'kategori_id' => Kategori::where('nama', 'Roti Manis')->first()->id,
            'nama' => 'Roti Sobek Cokelat',
            'slug' => Str::slug('Roti Sobek Cokelat'),
            'gambar' => null,
            'deskripsi' => 'Roti sobek lembut dengan isian cokelat.',
            'cara_pembuatan' => 'Campurkan bahan, uleni hingga kalis, diamkan, bentuk adonan lalu panggang.',
            'waktu_pembuatan' => 120,
            'porsi' => 8,
            'status' => true,
        ]);

        Resep::create([
            'kategori_id' => Kategori::where('nama', 'Donat')->first()->id,
            'nama' => 'Donat Kentang',
            'slug' => Str::slug('Donat Kentang'),
            'gambar' => null,
            'deskripsi' => 'Donat empuk dengan campuran kentang.',
            'cara_pembuatan' => 'Campur bahan, fermentasi, bentuk donat dan goreng hingga matang.',
            'waktu_pembuatan' => 90,
            'porsi' => 10,
            'status' => true,
        ]);
    }
}