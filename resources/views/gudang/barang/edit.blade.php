@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto;">

    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">✏️ Edit Barang</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">Ubah data barang</p>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2; padding:10px; border-radius:8px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gudang.barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Kode Barang</label><br>
            <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Nama Barang</label><br>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Harga</label><br>
            <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Stok</label><br>
            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Supplier</label><br>
            <select name="supplier_id" style="width:100%; padding:8px;">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" {{ old('supplier_id', $barang->supplier_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Kategori</label><br>
            <select name="kategori_id" style="width:100%; padding:8px;">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id', $barang->kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn btn-success">💾 Update</button>
            <a href="{{ route('gudang.barang.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</div>
@endsection