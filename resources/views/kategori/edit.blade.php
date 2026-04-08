@extends('layouts.app')

@section('page-title', 'Edit Kategori')
@section('breadcrumb', 'Manajemen / Kategori / Edit')

@section('content')

<div style="max-width:520px">
    <div class="card" style="padding:28px">

        <div style="margin-bottom:24px">
            <div style="font-size:15px;font-weight:600;color:#111827">Edit Kategori</div>
            <div style="font-size:12px;color:#9ca3af;margin-top:2px">Perbarui data kategori</div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0;padding-left:16px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Contoh: Makanan, Minuman...">
            </div>

            <div style="display:flex;gap:10px;margin-top:8px">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">💾 Update</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn" style="flex:1;justify-content:center;background:#f3f4f6;color:#374151">← Kembali</a>
            </div>

        </form>
    </div>
</div>

@endsection