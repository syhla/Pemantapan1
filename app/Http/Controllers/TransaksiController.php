<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Distribusi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // 📋 LIST
    public function index()
    {
        if (auth()->user()->role == 'gerai') {
            $transaksis = Transaksi::with(['barang', 'gerai'])
                ->where('gerai_id', auth()->user()->gerai_id)
                ->latest()
                ->get();
        } else {
            $transaksis = Transaksi::with(['barang', 'gerai'])
                ->latest()
                ->get();
        }

        return view('transaksi.index', compact('transaksis'));
    }

    // ➕ CREATE
    public function create()
    {
        if (auth()->user()->role != 'gerai') {
            abort(403);
        }

        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    // 💾 STORE REQUEST GERAI
    public function store(Request $request)
    {
        if (auth()->user()->role != 'gerai') {
            abort(403);
        }

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        Transaksi::create([
            'barang_id' => $request->barang_id,
            'gerai_id' => auth()->user()->gerai_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending'
        ]);

        return redirect()->route('gerai.transaksi.index')
            ->with('success', 'Request berhasil dikirim');
    }

    // ✅ APPROVE ADMIN (AUTO DISTRIBUSI)
    public function approve($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $transaksi = Transaksi::findOrFail($id);

        // kalau sudah diproses
        if ($transaksi->status != 'pending') {
            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Transaksi sudah diproses');
        }

        $barang = Barang::findOrFail($transaksi->barang_id);

        // stok tidak cukup
        if ($barang->stok < $transaksi->jumlah) {
            $transaksi->update(['status' => 'ditolak']);

            return redirect()->route('admin.transaksi.index')
                ->with('error', 'Stok tidak cukup, transaksi ditolak');
        }

        // kurangi stok
        $barang->decrement('stok', $transaksi->jumlah);

        // update status
        $transaksi->update(['status' => 'approved']);

        // buat distribusi
        Distribusi::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $transaksi->barang_id,
            'gerai_id' => $transaksi->gerai_id,
            'jumlah' => $transaksi->jumlah,
            'tanggal_kirim' => now(),
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('success', 'Transaksi disetujui & dikirim');
    }
    // ❌ REJECT ADMIN
    public function reject($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'ditolak'
        ]);

        return redirect()->route('admin.transaksi.index')
            ->with('error', 'Transaksi ditolak');
    }
    // 👁 DETAIL
    public function show($id)
    {
        $transaksi = Transaksi::with(['barang', 'gerai'])->findOrFail($id);

        if (auth()->user()->role == 'gerai' &&
            $transaksi->gerai_id != auth()->user()->gerai_id) {
            abort(403);
        }

        return view('transaksi.show', compact('transaksi'));
    }
}