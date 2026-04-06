@extends('layouts.app')

@section('content')

<div class="card">

<h2>✏️ Edit Barang</h2>
<p style="color:#64748b; font-size:14px;">Update data barang</p>

<form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" style="margin-top:20px;">
    @csrf
    @method('PUT')

    <!-- KODE -->
    <label>Kode Barang</label>
    <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}">
    @error('kode_barang')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- KATEGORI -->
    <label>Kategori</label>
    <select name="kategori_id">
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>

    <!-- NAMA -->
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}">

    <!-- HARGA -->
    <label>Harga</label>
    <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}">

    <!-- STOK -->
    <label>Stok</label>
    <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}">

    <!-- SUPPLIER -->
    <label>Supplier</label>
    <select name="supplier_id">
        @foreach($suppliers as $s)
            <option value="{{ $s->id }}" {{ $barang->supplier_id == $s->id ? 'selected' : '' }}>
                {{ $s->nama_supplier }}
            </option>
        @endforeach
    </select>

    <!-- BUTTON -->
    <div style="margin-top:15px; display:flex; gap:10px;">
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.barang.index') }}" class="btn btn-danger">Kembali</a>
    </div>

</form>

</div>

@endsection