<?php

namespace App\Http\Controllers;

use App\Models\Gerai;
use Illuminate\Http\Request;

class GeraiController extends Controller
{
    public function index()
    {
        $gerais = Gerai::all();
        return view('gerai.index', compact('gerais'));
    }

    public function create()
    {
        return view('gerai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gerai'=>'required',
            'alamat'=>'required',
            'kota'=>'required',
            'telepon'=>'required'
        ]);

        Gerai::create($request->all());
        return redirect()->route('gerai.index')->with('success','Gerai ditambah');
    }

    public function edit($id)
    {
        $gerai = Gerai::findOrFail($id);
        return view('gerai.edit', compact('gerai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gerai'=>'required',
            'alamat'=>'required',
            'kota'=>'required',
            'telepon'=>'required'
        ]);

        Gerai::findOrFail($id)->update($request->all());
        return redirect()->route('gerai.index')->with('success','Gerai diupdate');
    }

    public function destroy($id)
    {
        Gerai::findOrFail($id)->delete();
        return back()->with('success','Gerai dihapus');
    }
}