@extends('layouts.app')

@section('content')

<div class="card">

    <h2>📄 Data Transaksi</h2>

    @if(auth()->user()->role == 'gerai')
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            + Request Barang
        </a>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Gerai</th>
                <th>Jumlah</th>
                <th>Status</th>
                @if(auth()->user()->role == 'admin')
                <th>Aksi</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($transaksis as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->barang->nama_barang }}</td>
                <td>{{ $t->gerai->nama_gerai }}</td>
                <td>{{ $t->jumlah }}</td>

                <td>
                    @if($t->status == 'pending')
                        🟡 Pending
                    @elseif($t->status == 'approved')
                        🟢 Approved
                    @else
                        🔴 Ditolak
                    @endif
                </td>

                @if(auth()->user()->role == 'admin')
                <td>
                    <a href="/transaksi/{{ $t->id }}/approve" class="btn btn-success">ACC</a>
                    <a href="/transaksi/{{ $t->id }}/reject" class="btn btn-danger">Tolak</a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection