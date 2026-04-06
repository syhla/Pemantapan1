@extends('layouts.app')

@section('content')

<div class="card">

<h2>➕ Tambah Supplier</h2>
<p style="color:#64748b; font-size:14px;">Masukkan data supplier baru</p>

<form action="{{ route('admin.supplier.store') }}" method="POST" style="margin-top:20px;">
@csrf

<label>Nama Supplier</label>
<input type="text" name="nama_supplier" value="{{ old('nama_supplier') }}">
@error('nama_supplier')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Alamat</label>
<input type="text" name="alamat" value="{{ old('alamat') }}">
@error('alamat')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Kota</label>
<input type="text" name="kota" value="{{ old('kota') }}">
@error('kota')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Telepon</label>
<input type="text" name="telepon" value="{{ old('telepon') }}">
@error('telepon')
    <small style="color:red;">{{ $message }}</small>
@enderror

<div style="margin-top:15px; display:flex; gap:10px;">
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-danger">Kembali</a>
</div>

</form>
</div>

@endsection