<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GeraiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);
Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| RESET PASSWORD (FIRST LOGIN ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:gerai'])->group(function () {
    Route::get('/reset-password', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'force.reset'])->group(function(){

    // ================= ADMIN =================
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])
        ->prefix('admin')
        ->as('admin.')
        ->group(function(){

            Route::get('barang',[BarangController::class,'index'])->name('barang.index');
            Route::post('barang/{id}/approve',[BarangController::class,'approve'])->name('barang.approve');
            Route::post('barang/{id}/reject',[BarangController::class,'reject'])->name('barang.reject');

            Route::resource('supplier', SupplierController::class);
            Route::resource('gerai', GeraiController::class);
            Route::resource('kategori', KategoriController::class);

            Route::get('transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
            Route::post('transaksi/{id}/approve',[TransaksiController::class,'approve'])->name('transaksi.approve');
            Route::post('transaksi/{id}/reject',[TransaksiController::class,'reject'])->name('transaksi.reject');

            Route::get('distribusi',[DistribusiController::class,'index'])->name('distribusi.index');
        });

    // ================= GUDANG =================
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gudang'])
        ->prefix('gudang')
        ->as('gudang.')
        ->group(function(){

            Route::resource('barang', BarangController::class);
            Route::resource('distribusi', DistribusiController::class);
        });

    // ================= GERAI =================
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':gerai'])
        ->prefix('gerai')
        ->as('gerai.')
        ->group(function(){

            Route::resource('transaksi', TransaksiController::class)
                ->except(['destroy','edit','update']);
        });

    // ================= PROFILE =================
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
});