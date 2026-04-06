<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'kategori_id',
        'supplier_id',
        'nama_barang',
        'harga',
        'stok',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function distribusis(){
        return $this->hasMany(Distribusi::class);
    }


}
