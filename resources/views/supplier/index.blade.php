@extends('layouts.app')

@section('content')

<div class="card">

    <h2>📋 Data Supplier</h2>

    <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary" style="margin-top:10px;">
        ➕ Tambah Supplier
    </a>

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
            @foreach ($suppliers as $key => $supplier)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $supplier->nama_supplier }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>{{ $supplier->kota }}</td>
                <td>{{ $supplier->telepon }}</td>
                <td style="display:flex; gap:5px;">
                    <a href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn btn-success">Edit</a>

                    <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection