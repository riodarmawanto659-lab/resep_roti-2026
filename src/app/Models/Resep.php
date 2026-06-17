<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', true);
    }

    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        $keyword = trim((string) $keyword);

        if ($keyword === '') {
            return $query;
        }

        return $query->where(function (Builder $query) use ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%")
                ->orWhereHas('kategori', function (Builder $categoryQuery) use ($keyword) {
                    $categoryQuery->where('nama', 'like', "%{$keyword}%");
                });
        });
    }

    public function scopeByKategori(Builder $query, mixed $kategoriId): Builder
    {
        if (blank($kategoriId)) {
            return $query;
        }

        return $query->where('kategori_id', $kategoriId);
    }
}
