<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Tampilkan semua supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    // Form tambah supplier
    public function create()
    {
        return view('supplier.create');
    }

    // Simpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier'=>'required',
            'alamat'=>'required',
            'kota'=>'required',
            'telepon'=>'required'
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.supplier.index')->with('success','Supplier ditambah');
    }

    // Form edit supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    // Update supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier'=>'required',
            'alamat'=>'required',
            'kota'=>'required',
            'telepon'=>'required'
        ]);

        Supplier::findOrFail($id)->update($request->all());

        return redirect()->route('admin.supplier.index')->with('success','Supplier diupdate');
    }

    // Hapus supplier
    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();

        return redirect()->route('admin.supplier.index')->with('success','Supplier dihapus');
    }
}