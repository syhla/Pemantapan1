<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Gerai;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['barang','gerai'])->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $gerais = Gerai::all();
        return view('transaksi.create', compact('barangs','gerais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'=>'required',
            'gerai_id'=>'required',
            'jumlah'=>'required|numeric|min:1'
        ]);

        Transaksi::create([
            'barang_id'=>$request->barang_id,
            'gerai_id'=>$request->gerai_id,
            'jumlah'=>$request->jumlah,
            'status'=>'pending'
        ]);

        return redirect()->route('transaksi.index')->with('success','Request dikirim');
    }

    public function approve($id)
    {
        $t = Transaksi::findOrFail($id);
        $t->status = 'approved';
        $t->save();

        return back()->with('success','Disetujui');
    }

    public function reject($id)
    {
        $t = Transaksi::findOrFail($id);
        $t->status = 'ditolak';
        $t->save();

        return back()->with('success','Ditolak');
    }
}