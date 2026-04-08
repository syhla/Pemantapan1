<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Semua user lihat barang
    public function index(Request $request)
    {
        $barangs = Barang::with(['supplier','kategori'])
            ->when($request->search, function($q) use ($request){
                $q->where('nama_barang', 'like', "%{$request->search}%")
                ->orWhere('kode_barang', 'like', "%{$request->search}%");
            })
            ->get();

        if(auth()->user()->role == 'admin'){
            $kategoris = Kategori::all(); // <-- tambahan
            return view('admin.barang.index', compact('barangs', 'kategoris'));
        } elseif(auth()->user()->role == 'gudang'){
            return view('gudang.barang.index', compact('barangs'));
        }
    }

    // Gudang create
    public function create()
    {
        $suppliers = Supplier::all();
        $kategoris = Kategori::all();
        return view('gudang.barang.create', compact('suppliers','kategoris'));
    }

    // Gudang store
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
        ]);

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'supplier_id' => $request->supplier_id,
            'kategori_id' => $request->kategori_id,
            'status' => 'active', // langsung aktif
        ]);

        return redirect()->route('gudang.barang.index')->with('success','Barang berhasil ditambahkan');
    }

    // Gudang edit
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $suppliers = Supplier::all();
        $kategoris = Kategori::all();
        return view('gudang.barang.edit', compact('barang','suppliers','kategoris'));
    }

    // Gudang update
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
        ]);

        // Hanya ubah status jika barang bukan baru
        if($barang->status == 'active'){
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'supplier_id' => $request->supplier_id,
                'kategori_id' => $request->kategori_id,
                'status' => 'pending_edit', // menunggu approval admin
            ]);
        }

        return redirect()->route('gudang.barang.index')->with('success','Barang berhasil diupdate, menunggu approval admin');
    }

    // Gudang delete request
    public function destroy(Barang $barang)
    {
        $barang->update([
            'status' => 'pending_delete', // menunggu approval admin
        ]);

        return redirect()->route('gudang.barang.index')->with('success','Barang masuk daftar delete, menunggu approval admin');
    }

    // Admin approve
    public function approve($id)
    {
        $barang = Barang::findOrFail($id);

        if($barang->status == 'pending_edit'){
            $barang->status = 'active';
            $barang->approved = true;
            $barang->save();
            return redirect()->route('admin.barang.index')->with('success','Edit barang berhasil diapprove');
        }

        if($barang->status == 'pending_delete'){
            $barang->delete();
            return redirect()->route('admin.barang.index')->with('success','Barang berhasil dihapus');
        }

        return redirect()->route('admin.barang.index')->with('info','Barang tidak memerlukan approval');
    }

    // Admin reject
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->status = 'rejected';
        $barang->rejected_reason = $request->reason;
        $barang->approved = false;
        $barang->save();

        return redirect()->route('admin.barang.index')
            ->with('success','Barang di-reject: '.$request->reason);
    }
}
