<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;

class DistribusiController extends Controller
{
    // 📋 LIST DISTRIBUSI
    public function index()
    {
        $distribusis = Distribusi::with(['barang', 'gerai', 'transaksi'])
            ->latest()
            ->get();

        return view('distribusi.index', compact('distribusis'));
    }
}