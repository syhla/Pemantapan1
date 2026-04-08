@extends('layouts.app')

@section('page-title', 'Data Barang')
@section('breadcrumb', 'Manajemen / Barang')

@section('content')

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">

        <div>
            <div style="font-size:15px;font-weight:600;color:#111827">Data Barang</div>
            <div style="font-size:12px;color:#9ca3af;margin-top:2px">Kelola data barang sesuai role</div>
        </div>

        <div style="display:flex;gap:10px;align-items:center">
            
            {{-- SEARCH --}}
            <form method="GET" style="display:flex;align-items:center;gap:8px">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari nama / kode barang..."
                    style="padding:8px 12px;border:1px solid #e5e7eb;border-radius:8px;font-size:13px;"
                >
                <button class="btn btn-primary btn-sm">Cari</button>
            </form>

            {{-- BUTTON TAMBAH --}}
            @if(auth()->user()->role == 'gudang')
                <a href="{{ route('gudang.barang.create') }}" class="btn btn-primary">
                    + Tambah Barang
                </a>
            @endif

        </div>

    </div>
<div class="card">
    <div style="overflow-x:auto">
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
                    <td style="color:#9ca3af;font-size:12px">{{ $b->kode_barang }}</td>
                    <td style="font-weight:500">{{ $b->nama_barang }}</td>
                    <td>
                        <span style="display:inline-flex;background:#ede9fe;color:#4c1d95;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                            {{ $b->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($b->stok > 50)
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:6px;height:6px;border-radius:50%;background:#22c55e"></span>{{ $b->stok }}
                            </span>
                        @elseif($b->stok > 10)
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:6px;height:6px;border-radius:50%;background:#f59e0b"></span>{{ $b->stok }}
                            </span>
                        @else
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:6px;height:6px;border-radius:50%;background:#ef4444"></span>{{ $b->stok }}
                            </span>
                        @endif
                    </td>
                    <td style="color:#6b7280">{{ $b->supplier->nama_supplier ?? '-' }}</td>
                    <td>
                        @php
                            $statusMap = [
                                'active'         => ['bg'=>'#dcfce7','color'=>'#15803d'],
                                'pending_edit'   => ['bg'=>'#fef3c7','color'=>'#92400e'],
                                'pending_delete' => ['bg'=>'#fee2e2','color'=>'#991b1b'],
                                'rejected'       => ['bg'=>'#f3f4f6','color'=>'#6b7280'],
                            ];
                            $s = $statusMap[$b->status] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                        @endphp
                        <span style="display:inline-flex;background:{{ $s['bg'] }};color:{{ $s['color'] }};padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                            {{ ucfirst(str_replace('_', ' ', $b->status)) }}
                        </span>
                    </td>
                    <td>
                        @if(auth()->user()->role == 'admin' && in_array($b->status, ['pending_edit','pending_delete']))
                            <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center">
                                <form action="{{ route('admin.barang.approve', $b->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">✅ Approve</button>
                                </form>
                                <form action="{{ route('admin.barang.reject', $b->id) }}" method="POST" style="display:flex;gap:5px;align-items:center">
                                    @csrf
                                    <input type="text" name="reason" placeholder="Alasan reject" required style="width:140px;padding:5px 10px;font-size:12px">
                                    <button type="submit" class="btn btn-danger btn-sm">❌ Reject</button>
                                </form>
                            </div>
                        @else
                            <span style="color:#9ca3af">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">📦</div>
                        <div style="font-size:13px">Belum ada data barang</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection