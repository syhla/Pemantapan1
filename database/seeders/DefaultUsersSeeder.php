<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Toko',
                'email' => 'admin@toko.com',
                'password' => Hash::make('admin123'), // password admin
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gudang Toko',
                'email' => 'gudang@toko.com',
                'password' => Hash::make('gudang123'), // password gudang
                'role' => 'gudang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gerai Toko',
                'email' => 'gerai@toko.com',
                'password' => Hash::make('gerai123'), // password gerai
                'role' => 'gerai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}