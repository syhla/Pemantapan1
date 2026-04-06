@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto;">

    <!-- HEADER -->
    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">✏️ Edit Kategori</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">
            Perbarui data kategori
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
    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label style="font-weight:500;">Nama Kategori</label>
            <input 
                type="text" 
                name="nama_kategori" 
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                placeholder="Contoh: Makanan, Minuman..."
            >
        </div>

        <!-- BUTTON -->
        <div style="display:flex; gap:10px;">
            <button class="btn btn-success">💾 Update</button>

            <a href="{{ route('admin.kategori.index') }}" 
               class="btn"
               style="background:#e5e7eb;">
                ← Kembali
            </a>
        </div>
    </form>

</div>
@endsection