<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWebsite extends Model
{
    protected $fillable = [
        'nama_website',
        'logo',
        'judul_hero',
        'subjudul_hero',
        'gambar_hero',
        'tentang_kami',
        'email',
        'telepon',
        'alamat',
    ];
}