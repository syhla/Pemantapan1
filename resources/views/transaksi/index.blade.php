@extends('layouts.app')

@section('page-title', 'Data Transaksi')
@section('breadcrumb', 'Operasional / Transaksi')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div>
        <div style="font-size:15px;font-weight:600;color:#111827">Data Transaksi</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Manajemen request barang gerai</div>
    </div>

    @if(auth()->user()->role == 'gerai')
        <a href="{{ route('gerai.transaksi.create') }}" class="btn btn-primary">+ Request Barang</a>
    @endif
</div>

<div class="card">
    <div style="overflow-x:auto">
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
                @forelse($transaksis as $t)
                <tr>
                    <td style="color:#9ca3af;font-size:12px">{{ $loop->iteration }}</td>

                    <td style="font-weight:500">
                        {{ $t->barang->nama_barang ?? '-' }}
                    </td>

                    <td style="color:#6b7280">
                        {{ $t->gerai->nama_gerai ?? '-' }}
                    </td>

                    <td>{{ $t->jumlah }}</td>

                    {{-- STATUS --}}
                <td>
                    @if($t->status == 'pending')
                        <span style="background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:12px">
                            ⏳ Pending
                        </span>

                    @elseif($t->status == 'approved')
                        <span style="background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:20px;font-size:12px">
                            ✔ Approved
                        </span>

                    @elseif($t->status == 'ditolak')
                        <span style="background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:20px;font-size:12px">
                            ✖ Ditolak
                        </span>
                    @endif
                </td>
                    {{-- AKSI ADMIN --}}
                    @if(auth()->user()->role == 'admin')
                    <td>

                        @if($t->status == 'pending')
                        <div style="display:flex;gap:6px">

                            <form action="{{ route('admin.transaksi.approve', $t->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background:#dcfce7;color:#15803d">
                                    ✔ ACC
                                </button>
                            </form>

                            <form action="{{ route('admin.transaksi.reject', $t->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background:#fee2e2;color:#991b1b">
                                    ✖ Tolak
                                </button>
                            </form>

                        </div>
                        @else
                            <span style="color:#9ca3af">—</span>
                        @endif

                    </td>
                    @endif

                </tr>

                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:#9ca3af">
                        Belum ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection