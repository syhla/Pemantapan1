<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusis = Distribusi::with(['barang','gerai','transaksi'])->get();
        return view('distribusi.index', compact('distribusis'));
    }

    public function create()
    {
        $transaksis = Transaksi::with(['barang','gerai'])
            ->where('status','approved')
            ->get();

        return view('distribusi.create', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id'=>'required',
            'jumlah'=>'required|numeric|min:1'
        ]);

        $transaksi = Transaksi::findOrFail($request->transaksi_id);
        $barang = Barang::findOrFail($transaksi->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error','Stok tidak cukup');
        }

        Distribusi::create([
            'transaksi_id'=>$transaksi->id,
            'barang_id'=>$barang->id,
            'gerai_id'=>$transaksi->gerai_id,
            'jumlah'=>$request->jumlah,
            'tanggal_kirim'=>now()
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect()->route('distribusi.index')->with('success','Barang dikirim');
    }
}