<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'gerai_id',
        'jumlah',
        'tanggal_kirim'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gerai()
    {
        return $this->belongsTo(Gerai::class);
    }

}
