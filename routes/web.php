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

// 🚀 Default: redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✨ LOGIN & LOGOUT di luar middleware auth
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 🔐 Semua route lain wajib login
Route::middleware(['auth'])->group(function () {

    // 👑 ADMIN
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])
        ->prefix('admin')
        ->as('admin.')
        ->group(function () {
            Route::resource('barang', BarangController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('supplier', SupplierController::class);
            Route::resource('gerai', GeraiController::class);

            Route::get('/transaksi', [TransaksiController::class, 'index'])
                ->name('transaksi.index');
            Route::get('/transaksi/{id}/approve', [TransaksiController::class, 'approve'])
                ->name('transaksi.approve');
            Route::get('/transaksi/{id}/reject', [TransaksiController::class, 'reject'])
                ->name('transaksi.reject');
        });

    // 🏭 GUDANG
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gudang'])
        ->prefix('gudang')
        ->as('gudang.')
        ->group(function () {
            Route::get('/', [BarangController::class, 'gudang'])->name('index');
            Route::resource('distribusi', DistribusiController::class);
        });

    // 🏪 GERAI
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gerai'])
        ->prefix('gerai')
        ->as('gerai.')
        ->group(function () {
            Route::resource('transaksi', TransaksiController::class);
        });

    // PROFILE SEMUA ROLE BOLEH
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});