@extends('layouts.app')

@section('content')

<div class="card" style="max-width:500px; margin:auto; padding:20px;">

<h2 style="margin-bottom:15px;">🛒 Request Barang</h2>

{{-- Notifikasi error --}}
@if ($errors->any())
    <div style="background:#fee2e2; color:#991b1b; padding:10px; margin-bottom:15px; border-radius:5px;">
        <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('gerai.transaksi.store') }}" method="POST">
    @csrf

    {{-- Barang --}}
    <div style="margin-bottom:15px;">
        <label>Barang</label><br>
        <select name="barang_id" style="width:100%; padding:8px;" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs as $b)
                <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                    {{ $b->nama_barang }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Jumlah --}}
    <div style="margin-bottom:15px;">
        <label>Jumlah</label><br>
        <input 
            type="number" 
            name="jumlah" 
            value="{{ old('jumlah') }}"
            min="1"
            style="width:100%; padding:8px;"
            placeholder="Masukkan jumlah"
            required
        >
    </div>

    {{-- Button --}}
    <button 
        type="submit" 
        class="btn btn-primary" 
        style="width:100%; padding:10px;"
    >
        Kirim Request
    </button>

</form>

</div>

@endsection
