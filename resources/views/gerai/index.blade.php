@extends('layouts.app')

@section('page-title', 'Data Gerai')
@section('breadcrumb', 'Manajemen / Gerai')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div>
        <div style="font-size:15px;font-weight:600;color:#111827">Data Gerai</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Daftar cabang toko</div>
    </div>
    <a href="{{ route('admin.gerai.create') }}" class="btn btn-primary">+ Tambah Gerai</a>
</div>

<div class="card">
    <div style="overflow-x:auto">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gerais as $g)
                <tr>
                    <td style="font-weight:500">{{ $g->nama_gerai }}</td>
                    <td style="color:#6b7280">{{ $g->alamat }}</td>
                    <td>
                        <span style="display:inline-flex;background:#e0f2fe;color:#0c4a6e;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:500">
                            {{ $g->kota }}
                        </span>
                    </td>
                    <td style="color:#6b7280">{{ $g->telepon }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.gerai.edit', $g->id) }}" class="btn btn-sm" style="background:#fef3c7;color:#92400e">✏️ Edit</a>
                            <form action="{{ route('admin.gerai.destroy', $g->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus gerai ini?')">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">🏬</div>
                        <div style="font-size:13px">Belum ada data gerai</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection