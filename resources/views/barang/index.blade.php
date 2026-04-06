@extends('layouts.app')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <div>
            <h2 style="margin:0;">📦 Data Barang</h2>
            <p style="margin:0; color:#64748b; font-size:14px;">Kelola data barang</p>
        </div>

        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary">
            + Tambah
        </a>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($barangs as $b)
            <tr>
                <td>{{ $b->kode_barang }}</td>
                <td>{{ $b->nama_barang }}</td>
                <td>
                    <span style="background:#e0e7ff; padding:5px 10px; border-radius:8px;">
                        {{ $b->kategori->nama_kategori ?? '-' }}                    
                    </span>
                </td>
                <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                <td>
                    @if($b->stok > 50)
                        <span style="color:green; font-weight:600;">{{ $b->stok }}</span>
                    @elseif($b->stok > 10)
                        <span style="color:orange; font-weight:600;">{{ $b->stok }}</span>
                    @else
                        <span style="color:red; font-weight:600;">{{ $b->stok }}</span>
                    @endif
                </td>
                <td>{{ $b->supplier->nama_supplier ?? '-' }}</td>
                <td style="display:flex; gap:5px;">
                    <a href="{{ route('admin.barang.edit', $b->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('admin.barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:10px;">Data barang kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection