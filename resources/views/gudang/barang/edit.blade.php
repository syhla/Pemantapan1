@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.05);">

    <!-- Header -->
    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">✏️ Edit Barang</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">Ubah data barang</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:8px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('gudang.barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Kode Barang -->
        <div style="margin-bottom:15px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Kode Barang</label>
            <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" 
                   placeholder="Masukkan kode barang"
                   style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; box-shadow:inset 0 1px 2px rgba(0,0,0,0.05);">
        </div>

        <!-- Nama Barang -->
        <div style="margin-bottom:15px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" 
                   placeholder="Masukkan nama barang"
                   style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; box-shadow:inset 0 1px 2px rgba(0,0,0,0.05);">
        </div>

        <!-- Harga -->
        <div style="margin-bottom:15px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}" 
                   placeholder="Masukkan harga barang"
                   style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; box-shadow:inset 0 1px 2px rgba(0,0,0,0.05);">
        </div>

        <!-- Stok -->
        <div style="margin-bottom:15px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" 
                   placeholder="Masukkan jumlah stok"
                   style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; box-shadow:inset 0 1px 2px rgba(0,0,0,0.05);">
        </div>

        <!-- Supplier -->
        <div style="margin-bottom:15px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Supplier</label>
            <select name="supplier_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" {{ old('supplier_id', $barang->supplier_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_supplier }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Kategori -->
        <div style="margin-bottom:20px;">
            <label style="font-weight:500; display:block; margin-bottom:5px;">Kategori</label>
            <select name="kategori_id" style="width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db;">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id', $barang->kategori_id) == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Buttons -->
        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn btn-success" style="flex:1; padding:12px; border-radius:8px;">💾 Update</button>
            <a href="{{ route('gudang.barang.index') }}" class="btn btn-secondary" style="flex:1; padding:12px; border-radius:8px;">Batal</a>
        </div>

    </form>

</div>
@endsection
