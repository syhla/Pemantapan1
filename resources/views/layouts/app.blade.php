<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8fafc; margin: 0; display: flex; }
        .sidebar { width: 230px; background: linear-gradient(180deg,#7c3aed,#4f46e5); color: white; min-height: 100vh; padding: 25px 20px; box-shadow: 2px 0 15px rgba(0,0,0,0.15); }
        .sidebar h2 { margin-bottom: 30px; font-size: 22px; }
        .sidebar a { display: block; color: #ede9fe; margin: 10px 0; text-decoration: none; padding: 10px 12px; border-radius: 12px; transition: 0.3s; }
        .sidebar a:hover { background: rgba(255,255,255,0.2); transform: translateX(5px); }
        .sidebar a.active { background: white; color: #4f46e5; font-weight: bold; }
        .content { flex: 1; padding: 35px; }
        .card { background: white; padding: 25px; border-radius: 18px; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .btn { padding: 9px 15px; border: none; border-radius: 12px; cursor: pointer; font-weight: 500; }
        .btn-primary { background: #7c3aed; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-success { background: #22c55e; color: white; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; }
        th { background: #ede9fe; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; }
        input, select { padding: 10px; border-radius: 12px; border: 1px solid #d1d5db; width: 100%; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>🏪 Toko</h2>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.barang.index') }}" class="{{ request()->is('admin/barang*') ? 'active' : '' }}">🛒 Barang</a>
                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">📂 Kategori</a>
                <a href="{{ route('admin.supplier.index') }}" class="{{ request()->is('admin/supplier*') ? 'active' : '' }}">🚚 Supplier</a>
                <a href="{{ route('admin.gerai.index') }}" class="{{ request()->is('admin/gerai*') ? 'active' : '' }}">🏬 Gerai</a>
                <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">📄 Transaksi</a>
            @elseif(auth()->user()->role === 'gudang')
                <a href="{{ route('gudang.index') }}" class="{{ request()->is('gudang') ? 'active' : '' }}">📦 Gudang</a>
                <a href="{{ route('gudang.distribusi.index') }}" class="{{ request()->is('gudang/distribusi*') ? 'active' : '' }}">🚚 Distribusi</a>
            @elseif(auth()->user()->role === 'gerai')
                <a href="{{ route('gerai.transaksi.index') }}" class="{{ request()->is('gerai/transaksi*') ? 'active' : '' }}">🛒 Request Barang</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger" style="margin-top:15px; width:100%;">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">🔐 Login</a>
        @endguest
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>