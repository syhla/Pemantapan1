<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerai extends Model
{
    protected $fillable = [
        'nama_gerai',
        'alamat',
        'kota',
        'telepon'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function distribusis()
    {
        return $this->hasMany(Distribusi::class);
    }
}
