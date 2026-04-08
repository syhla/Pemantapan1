@extends('layouts.app')

@section('content')
<div style="max-width:1200px; margin:auto; padding:20px;">

    <!-- HEADER -->
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
    
    <!-- CARD TABLE -->
    <div style="overflow-x:auto; border-radius:12px; border:1px solid #e5e7eb; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <table style="width:100%; border-collapse:collapse;">
            <thead style="background:#f3f4f6; position:sticky; top:0;">
                <tr>
                    <th style="padding:12px; text-align:left;">Kode</th>
                    <th style="padding:12px; text-align:left;">Nama</th>
                    <th style="padding:12px; text-align:left;">Kategori</th>
                    <th style="padding:12px; text-align:right;">Harga</th>
                    <th style="padding:12px; text-align:center;">Stok</th>
                    <th style="padding:12px; text-align:left;">Supplier</th>
                    <th style="padding:12px; text-align:center;">Status</th>
                    <th style="padding:12px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $b)
                <tr style="transition:0.3s;" 
                    onmouseover="this.style.backgroundColor='#f9fafb'" 
                    onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $b->kode_barang }}</td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $b->nama_barang }}</td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb;">
                        <span style="background:#e0e7ff; color:#1e40af; padding:4px 10px; border-radius:8px; font-size:13px;">
                            {{ $b->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb; text-align:right;">
                        Rp {{ number_format($b->harga,0,',','.') }}
                    </td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb; text-align:center;">
                        @if($b->stok > 50)
                            <span style="color:green; font-weight:600;">{{ $b->stok }}</span>
                        @elseif($b->stok > 10)
                            <span style="color:orange; font-weight:600;">{{ $b->stok }}</span>
                        @else
                            <span style="color:red; font-weight:600;">{{ $b->stok }}</span>
                        @endif
                    </td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb;">{{ $b->supplier->nama_supplier ?? '-' }}</td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb; text-align:center;">
                        @if($b->status == 'active')
                            <span style="background:#dcfce7; color:#166534; padding:4px 10px; border-radius:8px; font-size:13px;">✅ Active</span>
                        @elseif($b->status == 'pending_edit')
                            <span style="background:#fef9c3; color:#854d0e; padding:4px 10px; border-radius:8px; font-size:13px;">⏳ Pending Edit</span>
                        @elseif($b->status == 'pending_delete')
                            <span style="background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:8px; font-size:13px;">🗑️ Pending Delete</span>
                        @elseif($b->status == 'rejected')
                            <span title="{{ $b->rejected_reason }}" style="background:#f3f4f6; color:#6b7280; padding:4px 10px; border-radius:8px; font-size:13px;">❌ Rejected</span>
                        @endif
                    </td>
                    <td style="padding:12px; border-bottom:1px solid #e5e7eb; display:flex; gap:5px; justify-content:center; flex-wrap:wrap;">
                        @if(in_array($b->status, ['active', 'rejected']))
                            <a href="{{ route('gudang.barang.edit', $b->id) }}" class="btn btn-success" style="padding:5px 10px; font-size:13px;">✏️ Edit</a>
                            <form action="{{ route('gudang.barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:13px;">🗑️ Delete</button>
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
