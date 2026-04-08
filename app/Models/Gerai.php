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

    public function user()
    {
        return $this->hasOne(User::class);
    }
}