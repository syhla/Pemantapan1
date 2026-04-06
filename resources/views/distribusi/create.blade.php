@extends('layouts.app')

@section('content')

<div class="card">

<h2>🚚 Kirim Barang</h2>

<form action="{{ route('distribusi.store') }}" method="POST">
@csrf

<label>Pilih Transaksi</label>
<select name="transaksi_id">
    @foreach($transaksis as $t)
        <option value="{{ $t->id }}">
            {{ $t->barang->nama_barang }} - {{ $t->gerai->nama_gerai }} ({{ $t->jumlah }})
        </option>
    @endforeach
</select>

<label>Jumlah Kirim</label>
<input type="number" name="jumlah">

<button class="btn btn-success">Kirim</button>

</form>

</div>

@endsection