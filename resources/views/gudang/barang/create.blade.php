@extends('layouts.app')

@section('content')

<div class="card" style="max-width:700px; margin:auto; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">

    <!-- HEADER -->
    <div style="margin-bottom:25px;">
        <h2 style="margin:0;">➕ Tambah Barang</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">Masukkan data barang baru</p>
    </div>

    <form action="{{ route('gudang.barang.store') }}" method="POST">
        @csrf

        <!-- GRID INPUT -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

            <!-- KODE -->
            <div>
                <label style="font-weight:500; display:block; margin-bottom:5px;">Kode Barang</label>
                <input type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                       placeholder="Masukkan kode barang"
                       style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                @error('kode_barang')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- NAMA -->
            <div>
                <label style="font-weight:500; display:block; margin-bottom:5px;">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                       placeholder="Masukkan nama barang"
                       style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                @error('nama_barang')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- KATEGORI -->
            <div>
                <label style="font-weight:500; display:block; margin-bottom:5px;">Kategori</label>
                <select name="kategori_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
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
                <label style="font-weight:500; display:block; margin-bottom:5px;">Supplier</label>
                <select name="supplier_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
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
                <label style="font-weight:500; display:block; margin-bottom:5px;">Harga</label>
                <input type="number" name="harga" value="{{ old('harga') }}"
                       placeholder="Masukkan harga barang"
                       style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                @error('harga')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <!-- STOK -->
            <div>
                <label style="font-weight:500; display:block; margin-bottom:5px;">Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}"
                       placeholder="Masukkan jumlah stok"
                       style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                @error('stok')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <!-- BUTTONS -->
        <div style="margin-top:30px; display:flex; justify-content:space-between; align-items:center;">
            
            <a href="{{ route('gudang.barang.index') }}" 
               style="text-decoration:none; color:#64748b; font-weight:500;">
                ← Kembali
            </a>

            <button class="btn btn-primary" style="padding:12px 20px; border-radius:8px;">
                💾 Simpan Barang
            </button>

        </div>

    </form>

</div>

@endsection
