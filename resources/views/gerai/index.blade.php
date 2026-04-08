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

<div class="card" style="padding:0; overflow-x:auto;">
<table style="width:100%; border-collapse:collapse;">
    <thead style="background:#f3f4f6;">
        <tr>
            <th style="padding:12px;text-align:left;">Nama</th>
            <th style="padding:12px;text-align:left;">Alamat</th>
            <th style="padding:12px;text-align:left;">Kota</th>
            <th style="padding:12px;text-align:left;">Telepon</th>
            <th style="padding:12px;text-align:left;">Email Login</th>
            <th style="padding:12px;text-align:left;">Password Default</th>
            <th style="padding:12px;text-align:center;">Aksi</th>
        </tr>
    </thead>

    <tbody>
    @forelse($gerais as $g)
        <tr>
            <td style="padding:12px;">{{ $g->nama_gerai }}</td>
            <td style="padding:12px;">{{ $g->alamat }}</td>
            <td style="padding:12px;">
                <span style="background:#e0f2fe;color:#0c4a6e;padding:3px 10px;border-radius:8px;">
                    {{ $g->kota }}
                </span>
            </td>
            <td style="padding:12px;">{{ $g->telepon }}</td>

            <td style="padding:12px;">
                {{ $g->user->email ?? '-' }}
            </td>

            {{-- 🔥 FIX UTAMA ADA DI SINI --}}
            <td style="padding:12px;">
                @if($g->user && $g->user->password_default)
                    <span style="background:#fee2e2;color:#991b1b;padding:4px 8px;border-radius:6px;">
                        {{ $g->user->password_default }}
                    </span>
                @else
                    <span style="color:#9ca3af;">Sudah login</span>
                @endif
            </td>

            <td style="padding:12px;text-align:center;display:flex;gap:5px;justify-content:center;">
                <a href="{{ route('admin.gerai.edit', $g->id) }}" 
                   class="btn btn-sm" 
                   style="background:#fef3c7;color:#92400e;">
                   ✏️ Edit
                </a>

                <form action="{{ route('admin.gerai.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Yakin hapus gerai ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" style="text-align:center;padding:40px;color:#9ca3af;">
                Belum ada data gerai
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>
@endsection