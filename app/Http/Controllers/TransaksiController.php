<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Distribusi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['barang','gerai'])->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        Transaksi::create([
            'barang_id' => $request->barang_id,
            'gerai_id' => auth()->user()->gerai_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'dikirim' => false,
        ]);

        return redirect()->route('gerai.transaksi.index')
                         ->with('success','Transaksi berhasil dibuat, menunggu approval admin');
    }

    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barang = $transaksi->barang;

        if ($barang->stok < $transaksi->jumlah) {
            return back()->with('error','Stok tidak mencukupi!');
        }

        // Kurangi stok
        $barang->stok -= $transaksi->jumlah;
        $barang->save();

        // Update status transaksi tetap valid
        $transaksi->status = 'approved';
        $transaksi->dikirim = true; // tandai sudah dikirim
        $transaksi->save();

        // Distribusi otomatis
        Distribusi::create([
            'barang_id' => $transaksi->barang_id,
            'gerai_id'  => $transaksi->gerai_id,
            'transaksi_id' => $transaksi->id,
            'jumlah'    => $transaksi->jumlah,
            'tanggal_kirim' => now(),
        ]);

        return back()->with('success','Transaksi diapprove, stok berkurang & distribusi tercatat otomatis');
    }

    public function reject($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'ditolak';        
        $transaksi->save();

        return back()->with('error','Transaksi ditolak');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['barang','gerai'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }
}