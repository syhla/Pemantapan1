@extends('layouts.app')

@section('content')

<div class="card">

<h2>➕ Tambah Barang</h2>
<p style="color:#64748b; font-size:14px;">Masukkan data barang</p>

<form action="{{ route('admin.barang.store') }}" method="POST" style="margin-top:20px;">
    @csrf

    <!-- KODE -->
    <label>Kode Barang</label>
    <input type="text" name="kode_barang" value="{{ old('kode_barang') }}">
    @error('kode_barang')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- KATEGORI -->
    <label>Kategori</label>
    <select name="kategori_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach
    </select>
    @error('kategori_id')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- NAMA -->
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}">
    @error('nama_barang')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- HARGA -->
    <label>Harga</label>
    <input type="number" name="harga" value="{{ old('harga') }}">
    @error('harga')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- STOK -->
    <label>Stok</label>
    <input type="number" name="stok" value="{{ old('stok') }}">
    @error('stok')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- SUPPLIER -->
    <label>Supplier</label>
    <select name="supplier_id">
        <option value="">-- Pilih Supplier --</option>
        @foreach($suppliers as $s)
            <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                {{ $s->nama_supplier }}
            </option>
        @endforeach
    </select>
    @error('supplier_id')
        <small style="color:red;">{{ $message }}</small>
    @enderror

    <!-- BUTTON -->
    <div style="margin-top:15px; display:flex; gap:10px;">
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.barang.index') }}" class="btn btn-danger">Kembali</a>
    </div>

</form>

</div>

@endsection