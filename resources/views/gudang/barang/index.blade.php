@extends('layouts.app')

@section('content')
<div style="max-width:1200px; margin:auto; padding:20px;">

    <!-- HEADER -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2 style="margin:0;">📦 Data Barang</h2>
            <p style="margin:0; color:#64748b; font-size:14px;">Kelola data barang</p>
        </div>
        <a href="{{ route('gudang.barang.create') }}" class="btn btn-primary" style="padding:8px 15px;">
            + Tambah
        </a>
    </div>

    @if(session('success'))
        <div style="color:green; margin-bottom:15px;">{{ session('success') }}</div>
    @endif

    <!-- TABLE -->
    <div style="overflow-x:auto; border-radius:10px; border:1px solid #e5e7eb;">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#f0f0f0;">
                <tr>
                    <th style="padding:10px;">Kode</th>
                    <th style="padding:10px;">Nama</th>
                    <th style="padding:10px;">Kategori</th>
                    <th style="padding:10px;">Harga</th>
                    <th style="padding:10px;">Stok</th>
                    <th style="padding:10px;">Supplier</th>
                    <th style="padding:10px;">Status</th>
                    <th style="padding:10px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $b)
                <tr style="transition:0.3s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">{{ $b->kode_barang }}</td>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">{{ $b->nama_barang }}</td>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">
                        <span style="background:#e0e7ff; padding:5px 10px; border-radius:8px;">
                            {{ $b->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">
                        @if($b->stok > 50)
                            <span style="color:green; font-weight:600;">{{ $b->stok }}</span>
                        @elseif($b->stok > 10)
                            <span style="color:orange; font-weight:600;">{{ $b->stok }}</span>
                        @else
                            <span style="color:red; font-weight:600;">{{ $b->stok }}</span>
                        @endif
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">{{ $b->supplier->nama_supplier ?? '-' }}</td>

                    <!-- STATUS -->
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;">
                        @if($b->status == 'active')
                            <span style="background:#dcfce7; color:#166534; padding:5px 10px; border-radius:8px;">✅ Active</span>
                        @elseif($b->status == 'pending_edit')
                            <span style="background:#fef9c3; color:#854d0e; padding:5px 10px; border-radius:8px;">⏳ Pending Edit</span>
                        @elseif($b->status == 'pending_delete')
                            <span style="background:#fee2e2; color:#991b1b; padding:5px 10px; border-radius:8px;">🗑️ Pending Delete</span>
                        @elseif($b->status == 'rejected')
                            <span style="background:#f3f4f6; color:#6b7280; padding:5px 10px; border-radius:8px;">❌ Rejected</span>
                            @if($b->rejected_reason)
                                <br>
                                <small style="color:#991b1b;">Alasan: {{ $b->rejected_reason }}</small>
                            @endif
                        @endif
                    </td>

                    <!-- AKSI -->
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb; display:flex; gap:5px; flex-wrap:wrap;">
                        @if(in_array($b->status, ['active', 'rejected']))
                            <a href="{{ route('gudang.barang.edit', $b->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('gudang.barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @else
                            <span style="color:#888; font-size:13px;">Menunggu approval admin</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:20px;">Data barang kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
