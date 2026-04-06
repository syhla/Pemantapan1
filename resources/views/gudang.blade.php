@extends('layouts.app')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <div>
            <h2 style="margin:0;">📦 Data Gudang</h2>
            <p style="margin:0; color:#64748b; font-size:14px;">
                Daftar semua barang tersedia
            </p>
        </div>
    </div>

    <!-- SEARCH -->
    <form method="GET" style="margin-bottom:20px; display:flex; gap:10px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Cari ID / Nama Barang..." 
            style="flex:1;"
        >
        <button class="btn btn-primary">Cari</button>
    </form>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Supplier</th>
            </tr>
        </thead>

        <tbody>
        @forelse($barangs as $b)
            <tr>
                <td>{{ $b->kode_barang }}</td>

                <!-- FIX KATEGORI -->
                <td>
                    <span style="background:#e0e7ff; padding:5px 10px; border-radius:8px;">
                        {{ $b->kategori->nama_kategori ?? '-' }}
                    </span>
                </td>

                <td>{{ $b->nama_barang }}</td>

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

                <!-- FIX SUPPLIER -->
                <td>
                    {{ $b->supplier->nama_supplier ?? '-' }}                
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;">Data tidak ditemukan</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection