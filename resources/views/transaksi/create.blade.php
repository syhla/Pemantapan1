@extends('layouts.app')

@section('content')

<div class="card">

<h2>🛒 Request Barang</h2>

<form action="{{ route('transaksi.store') }}" method="POST">
@csrf

<label>Barang</label>
<select name="barang_id">
    @foreach($barangs as $b)
        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
    @endforeach
</select>

<label>Gerai</label>
<select name="gerai_id">
    @foreach($gerais as $g)
        <option value="{{ $g->id }}">{{ $g->nama_gerai }}</option>
    @endforeach
</select>

<label>Jumlah</label>
<input type="number" name="jumlah">

<button class="btn btn-primary">Kirim</button>

</form>

</div>

@endsection