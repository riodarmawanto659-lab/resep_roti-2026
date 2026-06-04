<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $fillable = [
        'nama',
        'satuan',
    ];

    public function detailReseps()
    {
        return $this->hasMany(DetailResep::class);
    }
}