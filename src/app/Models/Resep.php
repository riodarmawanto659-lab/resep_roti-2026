<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'cara_pembuatan',
        'waktu_pembuatan',
        'porsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class);
    }
}