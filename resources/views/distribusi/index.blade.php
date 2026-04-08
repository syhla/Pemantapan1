@extends('layouts.app')

@section('page-title', 'Data Distribusi')
@section('breadcrumb', 'Operasional / Distribusi')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div>
        <div style="font-size:15px;font-weight:600;color:#111827">Data Distribusi</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Riwayat pengiriman barang ke gerai</div>
    </div>
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
                    <th>Tanggal Kirim</th>
                </tr>
            </thead>

            <tbody>
                @forelse($distribusis as $d)
                <tr>
                    <td style="color:#9ca3af;font-size:12px">{{ $loop->iteration }}</td>

                    <td style="font-weight:500">
                        {{ $d->barang->nama_barang ?? '-' }}
                    </td>

                    <td style="color:#6b7280">
                        {{ $d->gerai->nama_gerai ?? '-' }}
                    </td>

                    <td>{{ $d->jumlah }}</td>

                    <td style="color:#6b7280">
                        {{ \Carbon\Carbon::parse($d->tanggal_kirim)->format('d M Y H:i') }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">🚚</div>
                        <div style="font-size:13px">Belum ada data distribusi</div>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection