@extends('layouts.app')

@section('content')

<div class="card">

<h2>✏️ Edit Supplier</h2>
<p style="color:#64748b; font-size:14px;">Update data supplier</p>

<form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST" style="margin-top:20px;">
@csrf
@method('PUT')

<label>Nama Supplier</label>
<input type="text" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier) }}">
@error('nama_supplier')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Alamat</label>
<input type="text" name="alamat" value="{{ old('alamat', $supplier->alamat) }}">
@error('alamat')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Kota</label>
<input type="text" name="kota" value="{{ old('kota', $supplier->kota) }}">
@error('kota')
    <small style="color:red;">{{ $message }}</small>
@enderror

<label>Telepon</label>
<input type="text" name="telepon" value="{{ old('telepon', $supplier->telepon) }}">
@error('telepon')
    <small style="color:red;">{{ $message }}</small>
@enderror

<div style="margin-top:15px; display:flex; gap:10px;">
    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.supplier.index') }}" class="btn btn-danger">Kembali</a>
</div>

</form>
</div>

@endsection