<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'gerai_id',
        'barang_id',
        'jumlah',
        'status',
        'keterangan'
    ];

    public function gerai()
    {
        return $this->belongsTo(Gerai::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function distribusi()
    {
        return $this->hasOne(Distribusi::class);
    }
}
