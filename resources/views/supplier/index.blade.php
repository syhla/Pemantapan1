@extends('layouts.app')

@section('page-title', 'Data Supplier')
@section('breadcrumb', 'Manajemen / Supplier')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div>
        <div style="font-size:15px;font-weight:600;color:#111827">Data Supplier</div>
        <div style="font-size:12px;color:#9ca3af;margin-top:2px">Kelola data supplier barang</div>
    </div>
    <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">+ Tambah Supplier</a>
</div>

<div class="card">
    <div style="overflow-x:auto">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $key => $supplier)
                <tr>
                    <td style="color:#9ca3af;font-size:12px">{{ $key + 1 }}</td>
                    <td style="font-weight:500">{{ $supplier->nama_supplier }}</td>
                    <td style="color:#6b7280">{{ $supplier->alamat }}</td>
                    <td style="color:#6b7280">{{ $supplier->kota }}</td>
                    <td style="color:#6b7280">{{ $supplier->telepon }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn btn-sm" style="background:#fef3c7;color:#92400e">✏️ Edit</a>
                            <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus supplier ini?')">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px 16px;color:#9ca3af">
                        <div style="font-size:28px;margin-bottom:8px">🏭</div>
                        <div style="font-size:13px">Belum ada data supplier</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection