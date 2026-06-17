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
        $reseps = [
            [
                'kategori' => 'Roti Manis',
                'nama' => 'Roti Sobek Cokelat',
                'deskripsi' => 'Roti sobek lembut dengan isian cokelat manis yang cocok untuk camilan keluarga.',
                'cara_pembuatan' => "Campurkan tepung, gula, ragi, susu, dan telur sampai setengah kalis.\nMasukkan mentega dan garam, lalu uleni sampai kalis elastis.\nDiamkan adonan selama 45 menit sampai mengembang dua kali lipat.\nBagi adonan, isi dengan cokelat, lalu susun di loyang.\nProofing kembali 20 menit, oles permukaan, lalu panggang sampai matang.",
                'waktu_pembuatan' => 120,
                'porsi' => 8,
            ],
            [
                'kategori' => 'Donat',
                'nama' => 'Donat Kentang Lembut',
                'deskripsi' => 'Donat empuk dengan campuran kentang kukus sehingga teksturnya lebih moist.',
                'cara_pembuatan' => "Campurkan tepung, kentang, gula, ragi, telur, dan susu sampai rata.\nUleni hingga setengah kalis, lalu tambahkan mentega dan garam.\nDiamkan adonan sampai mengembang.\nCetak adonan menjadi bentuk donat dan proofing lagi.\nGoreng dengan api sedang sampai kecokelatan.",
                'waktu_pembuatan' => 100,
                'porsi' => 10,
            ],
            [
                'kategori' => 'Roti Tawar',
                'nama' => 'Roti Tawar Susu',
                'deskripsi' => 'Roti tawar lembut dengan aroma susu yang cocok untuk sarapan dan bekal.',
                'cara_pembuatan' => "Campurkan semua bahan kering dalam bowl.\nTuang susu cair sedikit demi sedikit sambil diuleni.\nTambahkan mentega dan garam, uleni sampai elastis.\nFermentasikan adonan, bentuk memanjang, lalu masukkan ke loyang.\nPanggang sampai permukaan berwarna golden brown.",
                'waktu_pembuatan' => 140,
                'porsi' => 12,
            ],
            [
                'kategori' => 'Roti Gurih',
                'nama' => 'Roti Keju Gurih',
                'deskripsi' => 'Roti gurih dengan taburan keju yang cocok dijadikan menu jualan bakery.',
                'cara_pembuatan' => "Buat adonan dasar roti sampai kalis.\nDiamkan adonan sampai mengembang.\nBentuk adonan sesuai ukuran, beri topping keju.\nProofing kembali sampai ringan.\nPanggang sampai matang dan keju berwarna kecokelatan.",
                'waktu_pembuatan' => 115,
                'porsi' => 9,
            ],
            [
                'kategori' => 'Pastry',
                'nama' => 'Pastry Cokelat Mini',
                'deskripsi' => 'Pastry mini dengan isian cokelat yang renyah di luar dan manis di dalam.',
                'cara_pembuatan' => "Siapkan lembar pastry dan potong sesuai ukuran.\nIsi bagian tengah dengan cokelat.\nLipat dan rapatkan pinggirannya.\nOles permukaan dengan telur.\nPanggang hingga mengembang dan renyah.",
                'waktu_pembuatan' => 75,
                'porsi' => 12,
            ],
            [
                'kategori' => 'Roti Manis',
                'nama' => 'Roti Mix Karamel',
                'deskripsi' => 'Roti manis bertema karamel dengan warna golden brown yang sesuai dengan identitas Roti Mix.',
                'cara_pembuatan' => "Campurkan bahan dasar roti sampai rata.\nUleni sampai kalis elastis.\nDiamkan adonan hingga mengembang.\nBentuk adonan dan beri isian manis sesuai selera.\nPanggang sampai permukaan berwarna karamel.",
                'waktu_pembuatan' => 125,
                'porsi' => 8,
            ],
        ];

        foreach ($reseps as $item) {
            $kategori = Kategori::where('nama', $item['kategori'])->first();

            if (! $kategori) {
                continue;
            }

            Resep::updateOrCreate(
                ['slug' => Str::slug($item['nama'])],
                [
                    'kategori_id' => $kategori->id,
                    'nama' => $item['nama'],
                    'slug' => Str::slug($item['nama']),
                    'gambar' => null,
                    'deskripsi' => $item['deskripsi'],
                    'cara_pembuatan' => $item['cara_pembuatan'],
                    'waktu_pembuatan' => $item['waktu_pembuatan'],
                    'porsi' => $item['porsi'],
                    'status' => true,
                ]
            );
        }
    }
}
