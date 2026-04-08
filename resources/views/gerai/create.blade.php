@extends('layouts.app')

@section('page-title', 'Tambah Gerai')
@section('breadcrumb', 'Manajemen / Gerai / Tambah')

@section('content')
<div style="max-width:520px">
<div class="card" style="padding:28px">

    <div style="margin-bottom:24px">
        <div style="font-size:15px;font-weight:600;color:#111827">Tambah Gerai</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Masukkan data cabang toko baru</div>
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

    <form action="{{ route('admin.gerai.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Gerai</label>
            <input type="text" name="nama_gerai" value="{{ old('nama_gerai') }}" placeholder="Masukkan nama gerai">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Jl. Contoh No. 123">
        </div>

        <div class="form-group">
            <label>Kota</label>
            <input type="text" name="kota" value="{{ old('kota') }}" placeholder="Contoh: Jakarta">
        </div>

        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08123456789">
        </div>

        <div class="form-group">
            <label>Email Login</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@toko.com">
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary" style="flex:1">💾 Simpan</button>
            <a href="{{ route('admin.gerai.index') }}" class="btn" style="flex:1;background:#f3f4f6;color:#374151">Batal</a>
        </div>

    </form>
</div>
</div>
@endsection