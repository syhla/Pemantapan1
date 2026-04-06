<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Fillable supaya bisa mass assign
    protected $fillable = [
        'kode_barang',
        'kategori_id',
        'supplier_id',
        'nama_barang',
        'harga',
        'stok',
        'status',
        'approved',         // untuk approval admin
        'rejected_reason',  // alasan reject
    ];

    /**
     * Relasi ke kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relasi ke transaksi (jika perlu)
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    /**
     * Relasi ke distribusi (jika perlu)
     */
    public function distribusis()
    {
        return $this->hasMany(Distribusi::class);
    }
}