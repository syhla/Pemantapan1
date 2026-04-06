<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusis = Distribusi::with(['barang','gerai','transaksi'])->get();
        return view('distribusi.index', compact('distribusis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $transaksi = Transaksi::with('barang')->findOrFail($request->transaksi_id);
        $barang = $transaksi->barang;

        // ❌ CEK STOK
        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok gudang tidak cukup!');
        }

        // ❌ CEK BIAR GA DOUBLE KIRIM
        if ($transaksi->status == 'dikirim') {
            return back()->with('error', 'Transaksi sudah dikirim!');
        }

        // ✅ SIMPAN DISTRIBUSI
        Distribusi::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $transaksi->barang_id,
            'gerai_id' => $transaksi->gerai_id,
            'jumlah' => $request->jumlah,
            'tanggal_kirim' => now()
        ]);

        // ✅ KURANGI STOK GUDANG
        $barang->stok -= $request->jumlah;
        $barang->save();

        // ✅ UPDATE STATUS TRANSAKSI
        $transaksi->status = 'dikirim';
        $transaksi->save();

        return redirect()->route('gudang.distribusi.index')
            ->with('success', 'Distribusi berhasil + stok diperbarui');
    }
}