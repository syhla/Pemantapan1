@extends('layouts.app')

@section('content')

<div class="card">

<h2>🚚 Data Distribusi</h2>

<a href="{{ route('distribusi.create') }}" class="btn btn-primary">
    + Kirim Barang
</a>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Barang</th>
    <th>Gerai</th>
    <th>Jumlah</th>
    <th>Tanggal</th>
</tr>
</thead>

<tbody>
@foreach($distribusis as $d)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->barang->nama_barang }}</td>
    <td>{{ $d->gerai->nama_gerai }}</td>
    <td>{{ $d->jumlah }}</td>
    <td>{{ $d->tanggal_kirim }}</td>
</tr>
@endforeach
</tbody>

</table>

</div>

@endsection