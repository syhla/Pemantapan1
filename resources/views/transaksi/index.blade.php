@extends('layouts.app')

@section('content')

<div class="card">
    <h2>📄 Data Transaksi</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Gerai</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transaksis as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $t->gerai->nama_gerai ?? '-' }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>
                        @if($t->status == 'pending')
                            🟡 Pending
                        @elseif($t->status == 'approved')
                            🟢 Approved
                        @else
                            🔴 Ditolak
                        @endif
                    </td>
                    <td style="display:flex; gap:5px;">
                        @if(auth()->user()->role == 'admin' && $t->status == 'pending')
                            {{-- APPROVE --}}
                            <form action="{{ route('admin.transaksi.approve', $t->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">ACC</button>
                            </form>

                            {{-- REJECT --}}
                            <form action="{{ route('admin.transaksi.reject', $t->id) }}" method="POST">
                                @csrf
                                <input type="text" name="reason" placeholder="Alasan reject" required style="width:120px; height:28px;">
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data transaksi kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection