@extends('layouts.app')

@section('content')

<div class="card">
    <h2>🚚 Data Distribusi</h2>
<table class="table table-bordered mt-2">
    <thead>
        <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Gerai</th>
            <th>Jumlah</th>
            <th>Tanggal Kirim</th>
        </tr>
    </thead>
    <tbody>
        @forelse($distribusis as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->barang->nama_barang }}</td>
            <td>{{ $d->gerai->nama_gerai }}</td>
            <td>{{ $d->jumlah }}</td>
            <td>{{ $d->tanggal_kirim }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center;">Belum ada distribusi</td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>
@endsection
