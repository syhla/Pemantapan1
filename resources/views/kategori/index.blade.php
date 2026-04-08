@extends('layouts.app')

@section('page-title', 'Data Kategori')
@section('breadcrumb', 'Manajemen / Kategori')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div>
        <div style="font-size:15px;font-weight:600;color:#111827">Data Kategori</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Kelola kategori barang</div>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="card">
    <div style="overflow-x:auto">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $key => $kategori)
                <tr>
                    <td style="color:#9ca3af;font-size:12px">{{ $key + 1 }}</td>
                    <td style="font-weight:500">{{ $kategori->nama_kategori }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm" style="background:#fef3c7;color:#92400e">✏️ Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus kategori ini?')">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">📂</div>
                        <div style="font-size:13px">Belum ada data kategori</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection