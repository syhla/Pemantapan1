<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gerai;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ BUAT GERAI DULU
        $gerai = Gerai::create([
            'nama_gerai' => 'Gerai Toko',
            'alamat' => 'Jl. Anjani',
            'kota' => 'Jakarta',
            'telepon' => '08123456789'
        ]);

        // ✅ ADMIN
        User::create([
            'name' => 'Admin',
            'email' => 'admin@toko.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // ✅ GUDANG
        User::create([
            'name' => 'Gudang',
            'email' => 'gudang@toko.com',
            'password' => Hash::make('gudang123'),
            'role' => 'gudang',
        ]);

        // ✅ GERAI (INI YANG PENTING)
        User::create([
            'name' => 'Gerai Toko',
            'email' => 'gerai@toko.com',
            'password' => Hash::make('gerai123'),
            'role' => 'gerai',
            'gerai_id' => $gerai->id, // ✅ sekarang AMAN
        ]);
    }
}