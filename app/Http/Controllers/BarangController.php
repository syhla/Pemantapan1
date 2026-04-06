<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with(['supplier','kategori'])->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $kategoris = Kategori::all();
        return view('barang.create', compact('suppliers','kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
        ]);

        Barang::create($request->only([
            'kode_barang','nama_barang','harga','stok','supplier_id','kategori_id'
        ]));

        return redirect()->route('barang.index')->with('success','Barang ditambah');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $suppliers = Supplier::all();
        $kategoris = Kategori::all();

        return view('barang.edit', compact('barang','suppliers','kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,'.$id,
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success','Barang diupdate');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return back()->with('success','Barang dihapus');
    }
}