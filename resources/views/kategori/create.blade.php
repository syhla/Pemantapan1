@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto;">

    <!-- HEADER -->
    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">📂 Tambah Kategori</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">
            Tambahkan kategori baru untuk produk
        </p>
    </div>

    <!-- ERROR -->
    @if($errors->any())
        <div style="background:#fee2e2; padding:10px; border-radius:10px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li style="color:#b91c1c;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label style="font-weight:500;">Nama Kategori</label>
            <input 
                type="text" 
                name="nama_kategori" 
                placeholder="Contoh: Makanan, Minuman..."
                value="{{ old('nama_kategori') }}"
            >
        </div>

        <!-- BUTTON -->
        <div style="display:flex; gap:10px;">
            <button class="btn btn-success">💾 Simpan</button>

            <a href="{{ route('admin.kategori.index') }}" 
               class="btn"
               style="background:#e5e7eb;">
                ← Kembali
            </a>
        </div>
    </form>

</div>
@endsection