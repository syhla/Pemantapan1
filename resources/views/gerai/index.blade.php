@extends('layouts.app')

@section('content')
<div class="card">

<!-- HEADER -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
    <div>
        <h2 style="margin:0;">🏬 Data Gerai</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">Daftar cabang toko</p>
    </div>

    <!-- TAMBAH BUTTON -->
    <a href="{{ route('admin.gerai.create') }}" class="btn btn-primary">
        + Tambah
    </a>
</div>

<!-- TABLE -->
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
            <td><strong>{{ $g->nama }}</strong></td>
            <td>{{ $g->alamat }}</td>
            <td>
                <span style="background:#e0f2fe; padding:5px 10px; border-radius:8px;">
                    {{ $g->kota }}
                </span>
            </td>
            <td>{{ $g->telepon }}</td>

            <!-- AKSI -->
            <td style="display:flex; gap:5px;">
                <!-- EDIT -->
                <a href="{{ route('admin.gerai.edit', $g->id) }}" 
                   class="btn btn-success">
                    Edit
                </a>

                <!-- DELETE -->
                <form action="{{ route('admin.gerai.destroy', $g->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger"
                        onclick="return confirm('Yakin mau hapus?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align:center;">Data kosong</td>
        </tr>
    @endforelse
    </tbody>
</table>

</div>
@endsection