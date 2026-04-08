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
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'gudang')
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
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:7px;height:7px;border-radius:50%;background:#f59e0b"></span>
                                Pending
                            </span>
                        @elseif($t->status == 'approved')
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:7px;height:7px;border-radius:50%;background:#22c55e"></span>
                                Approved
                            </span>
                        @else
                            <span style="display:inline-flex;align-items:center;gap:5px;background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                                <span style="width:7px;height:7px;border-radius:50%;background:#ef4444"></span>
                                Ditolak
                            </span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    @if(auth()->user()->role == 'admin')
                    <td>

                        @if($t->status == 'pending')
                            <div style="display:flex;gap:6px">

                                <form action="{{ route('admin.transaksi.approve', $t->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm"
                                        style="background:#dcfce7;color:#15803d">
                                        ✔️ ACC
                                    </button>
                                </form>

                                <form action="{{ route('admin.transaksi.reject', $t->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm"
                                        style="background:#fee2e2;color:#991b1b">
                                        ✖️ Tolak
                                    </button>
                                </form>

                            </div>
                        @else
                            <span style="color:#9ca3af">—</span>
                        @endif

                    </td>
                    @elseif(auth()->user()->role == 'gudang')
                        <td>
                            @if($t->status == 'approved')
                                <form action="{{ route('gudang.distribusi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="transaksi_id" value="{{ $t->id }}">
                                    <input type="hidden" name="jumlah" value="{{ $t->jumlah }}">

                                    <button type="submit"
                                        class="btn btn-sm"
                                        style="background:#dbeafe;color:#1d4ed8">
                                        🚚 Kirim
                                    </button>
                                </form>
                            @else
                                <span style="color:#9ca3af">—</span>
                            @endif
                        </td>
                    @endif

                </tr>

                @empty
                <tr>
                    <td colspan="{{ (auth()->user()->role == 'admin' || auth()->user()->role == 'gudang') ? 6 : 5 }}"
                        style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">📄</div>
                        <div style="font-size:13px">Belum ada data transaksi</div>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection