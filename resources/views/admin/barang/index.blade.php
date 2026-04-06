@extends('layouts.app')

@section('content')

<div class="card">

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <div>
            <h2 style="margin:0;">📦 Data Barang</h2>
            <p style="margin:0; color:#64748b; font-size:14px;">Kelola data barang</p>
        </div>
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
                <th>Status</th>
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

                <!-- STATUS -->
                <td>
                    @if($b->status == 'active')
                        <span style="color:green; font-weight:600;">Active</span>
                    @elseif($b->status == 'pending_edit')
                        <span style="color:orange; font-weight:600;">Pending Edit</span>
                    @elseif($b->status == 'pending_delete')
                        <span style="color:red; font-weight:600;">Pending Delete</span>
                    @elseif($b->status == 'rejected')
                        <span style="color:gray; font-weight:600;">Rejected</span>
                    @endif
                </td>

                <!-- AKSI ADMIN -->
                <td>
                    @if(auth()->user()->role == 'admin' && in_array($b->status,['pending_edit','pending_delete']))
                        <form action="{{ route('admin.barang.approve',$b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="margin-right:5px;">✅ Approve</button>
                        </form>
                        <form action="{{ route('admin.barang.reject',$b->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="text" name="reason" placeholder="Alasan reject" required style="width:120px;">
                            <button type="submit" style="background:red; color:white;">❌ Reject</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:10px;">Data barang kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
