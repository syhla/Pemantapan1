@extends('layouts.app')

@section('page-title', 'Edit Gerai')
@section('breadcrumb', 'Manajemen / Gerai / Edit')

@section('content')

<div style="max-width:520px">
    <div class="card" style="padding:28px">

        <div style="margin-bottom:24px">
            <div style="font-size:15px;font-weight:600;color:#111827">Edit Gerai</div>
            <div style="font-size:12px;color:#9ca3af;margin-top:2px">Ubah data cabang toko</div>
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

        <form action="{{ route('admin.gerai.update', $gerai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Gerai</label>
                <input type="text" name="nama_gerai" value="{{ old('nama_gerai', $gerai->nama_gerai) }}" placeholder="Masukkan nama gerai">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $gerai->alamat) }}" placeholder="Jl. Contoh No. 123">
            </div>

            <div class="form-group">
                <label>Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $gerai->kota) }}" placeholder="Contoh: Jakarta">
            </div>

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $gerai->telepon) }}" placeholder="Contoh: 08123456789">
            </div>

            <div style="display:flex;gap:10px;margin-top:8px">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">💾 Update</button>
                <a href="{{ route('admin.gerai.index') }}" class="btn" style="flex:1;justify-content:center;background:#f3f4f6;color:#374151">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection