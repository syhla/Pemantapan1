<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GeraiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// 🚀 Default redirect ke login
Route::get('/', fn() => redirect()->route('login'));

// ✨ LOGIN & LOGOUT
Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);
Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');

// 🔐 Semua route lain wajib login
Route::middleware(['auth'])->group(function(){

    // 👑 ADMIN
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])
        ->prefix('admin')
        ->as('admin.')
        ->group(function(){

            // BARANG (view + approve/reject)
            Route::get('barang',[BarangController::class,'index'])->name('barang.index');
            Route::post('barang/{id}/approve',[BarangController::class,'approve'])->name('barang.approve'); // ubah ke POST
            Route::post('barang/{id}/reject',[BarangController::class,'reject'])->name('barang.reject');   // ubah ke POST

            // SUPPLIER (full CRUD)
            Route::resource('supplier', SupplierController::class);

            // GERAI (full CRUD)
            Route::resource('gerai', GeraiController::class);

            // KATEGORI (full CRUD)
            Route::resource('kategori', KategoriController::class);

            // TRANSAKSI (view + approve/reject)
            Route::get('transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
            Route::post('transaksi/{id}/approve',[TransaksiController::class,'approve'])->name('transaksi.approve'); // ubah ke POST
            Route::post('transaksi/{id}/reject',[TransaksiController::class,'reject'])->name('transaksi.reject');   // ubah ke POST

            // DISTRIBUSI (view only)
            Route::get('distribusi',[DistribusiController::class,'index'])->name('distribusi.index');
        });

    // 🏭 GUDANG
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gudang'])
        ->prefix('gudang')
        ->as('gudang.')
        ->group(function(){

            // BARANG (full CRUD)
            Route::resource('barang', BarangController::class);

            // DISTRIBUSI (full CRUD)
            Route::resource('distribusi', DistribusiController::class);
        });

    // 🏪 GERAI
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gerai'])
        ->prefix('gerai')
        ->as('gerai.')
        ->group(function(){

            // TRANSAKSI (buat transaksi baru / store)
            // **Tidak ada approve/reject karena gerai tidak punya hak itu**
            Route::resource('transaksi', TransaksiController::class)->except(['destroy','edit','update']);
        });

    // PROFILE (semua role boleh akses)
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
});
