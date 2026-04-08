@extends('layouts.app')

@section('page-title', 'Request Barang')
@section('breadcrumb', 'Operasional / Transaksi / Request')

@section('content')

<div style="max-width:520px">
    <div class="card" style="padding:28px">

        <div style="margin-bottom:24px">
            <div style="font-size:15px;font-weight:600;color:#111827">Request Barang</div>
            <div style="font-size:12px;color:#9ca3af;margin-top:2px">Ajukan permintaan barang ke gudang</div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left:16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('gerai.transaksi.store') }}" method="POST">
            @csrf

            {{-- Barang --}}
            <div class="form-group">
                <label>Barang</label>
                <select name="barang_id">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barangs as $b)
                        <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                            {{ $b->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div class="form-group">
                <label>Jumlah</label>
                <input 
                    type="number" 
                    name="jumlah" 
                    value="{{ old('jumlah') }}"
                    min="1"
                    placeholder="Contoh: 10"
                >
            </div>

            {{-- Button --}}
            <div style="display:flex;gap:10px;margin-top:8px">
                <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center">
                    📤 Kirim
                </button>

                <a href="{{ route('gerai.transaksi.index') }}"
                   class="btn"
                   style="flex:1;justify-content:center;background:#f3f4f6;color:#374151">
                   ← Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@endsection