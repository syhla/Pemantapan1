@extends('layouts.app')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">➕ Tambah Barang</h2>
        <p style="color:#64748b; font-size:14px;">Masukkan data barang baru</p>
    </div>

    <form action="{{ route('gudang.barang.store') }}" method="POST">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

            <!-- KODE -->
            <div>
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" value="{{ old('kode_barang') }}">
                @error('kode_barang')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- NAMA -->
            <div>
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}">
                @error('nama_barang')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- KATEGORI -->
            <div>
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
            </div>

            <!-- SUPPLIER -->
            <div>
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
            </div>

            <!-- HARGA -->
            <div>
                <label>Harga</label>
                <input type="number" name="harga" value="{{ old('harga') }}">
                @error('harga')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- STOK -->
            <div>
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}">
                @error('stok')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <!-- BUTTON -->
        <div style="margin-top:25px; display:flex; justify-content:space-between; align-items:center;">
            
            <a href="{{ route('gudang.barang.index') }}" 
               style="text-decoration:none; color:#64748b;">
                ← Kembali
            </a>

            <button class="btn btn-primary">
                💾 Simpan Barang
            </button>

        </div>

    </form>

</div>

@endsection