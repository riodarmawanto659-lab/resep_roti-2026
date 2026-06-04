<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    protected $fillable = [
        'resep_id',
        'bahan_id',
        'jumlah',
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }
}