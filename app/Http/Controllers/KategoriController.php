<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create($request->all());

        // redirect ke index dengan route prefix admin
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ditambah');
    }

    // Form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::findOrFail($id)->update($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori diupdate');
    }

    // Hapus kategori
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori dihapus');
    }
}