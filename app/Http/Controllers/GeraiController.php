<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gerai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class GeraiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $gerais = Gerai::with('user')
            ->when($search, function($q) use ($search){
                $q->where('nama_gerai', 'like', "%$search%")
                  ->orWhere('kota', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('gerai.index', compact('gerais'));
    }

    public function create()
    {
        return view('gerai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gerai' => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'telepon'    => 'required',
            'email'      => 'required|email|unique:users,email',
        ]);

        // 🔥 SIMPAN GERAI
        $gerai = Gerai::create([
            'nama_gerai' => $request->nama_gerai,
            'alamat'     => $request->alamat,
            'kota'       => $request->kota,
            'telepon'    => $request->telepon,
        ]);

        // 🔥 PASSWORD DEFAULT
        $password = 'gerai123';

        // 🔥 BUAT USER GERAI
        User::create([
            'name' => $gerai->nama_gerai,
            'email' => $request->email,
            'password' => Hash::make($password),
            'password_default' => $password,
            'role' => 'gerai',
            'gerai_id' => $gerai->id,
            'is_first_login' => true,
        ]);

        return redirect()->route('admin.gerai.index')
            ->with('success', "Gerai berhasil dibuat | Email: {$request->email} | Password: $password");
    }

    public function edit($id)
    {
        $gerai = Gerai::with('user')->findOrFail($id);
        return view('gerai.edit', compact('gerai'));
    }

    public function update(Request $request, $id)
    {
        $gerai = Gerai::findOrFail($id);

        $request->validate([
            'nama_gerai' => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'telepon'    => 'required',
            // 🔥 FIX VALIDASI EMAIL
            'email'      => 'required|email|unique:users,email,' . ($gerai->user->id ?? 'NULL'),
        ]);

        // 🔥 UPDATE GERAI
        $gerai->update([
            'nama_gerai' => $request->nama_gerai,
            'alamat'     => $request->alamat,
            'kota'       => $request->kota,
            'telepon'    => $request->telepon,
        ]);

        // 🔥 UPDATE USER
        if ($gerai->user) {
            $gerai->user->update([
                'name'  => $gerai->nama_gerai,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('admin.gerai.index')
            ->with('success', 'Gerai berhasil diupdate');
    }

    public function destroy($id)
    {
        $gerai = Gerai::findOrFail($id);

        // 🔥 HAPUS USER TERKAIT
        if ($gerai->user) {
            $gerai->user->delete();
        }

        // 🔥 HAPUS GERAI
        $gerai->delete();

        return back()->with('success', 'Gerai berhasil dihapus');
    }
}