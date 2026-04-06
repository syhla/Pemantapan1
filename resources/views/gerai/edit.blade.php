@extends('layouts.app')

@section('content')
<div class="card" style="max-width:500px; margin:auto;">

    <div style="margin-bottom:20px;">
        <h2 style="margin:0;">✏️ Edit Gerai</h2>
        <p style="margin:0; color:#64748b; font-size:14px;">Ubah data cabang toko</p>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2; padding:10px; border-radius:8px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gerai.update', $gerai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Nama Gerai</label><br>
            <input type="text" name="nama" value="{{ old('nama', $gerai->nama) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Alamat</label><br>
            <input type="text" name="alamat" value="{{ old('alamat', $gerai->alamat) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Kota</label><br>
            <input type="text" name="kota" value="{{ old('kota', $gerai->kota) }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Telepon</label><br>
            <input type="text" name="telepon" value="{{ old('telepon', $gerai->telepon) }}" style="width:100%; padding:8px;">
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn btn-success">💾 Update</button>
            <a href="{{ route('admin.gerai.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</div>
@endsection