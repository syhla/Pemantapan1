<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Indonesia</title>

```
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f1f5f9;
        margin: 0;
        display: flex;
    }

    /* SIDEBAR */
    .sidebar {
        width: 250px;
        background: linear-gradient(180deg,#6d28d9,#4f46e5);
        color: white;
        min-height: 100vh;
        padding: 30px 20px;
        box-shadow: 4px 0 25px rgba(0,0,0,0.15);
        position: fixed;
    }

    .sidebar h2 {
        margin-bottom: 40px;
        font-size: 22px;
        font-weight: 600;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #e0e7ff;
        margin: 8px 0;
        text-decoration: none;
        padding: 12px 14px;
        border-radius: 14px;
        transition: 0.25s;
        font-size: 14px;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.15);
        transform: translateX(6px);
    }

    .sidebar a.active {
        background: white;
        color: #4f46e5;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    /* CONTENT */
    .content {
        margin-left: 250px;
        padding: 40px;
        width: 100%;
    }

    /* CARD */
    .card {
        background: white;
        padding: 25px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    /* BUTTON */
    .btn {
        padding: 10px 16px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .btn-primary { background: #6d28d9; color: white; }
    .btn-danger { background: #ef4444; color: white; }
    .btn-success { background: #22c55e; color: white; }

    /* TABLE */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        background: white;
        border-radius: 14px;
        overflow: hidden;
    }

    th {
        background: #ede9fe;
        font-weight: 600;
        font-size: 14px;
    }

    th, td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    tr:hover {
        background: #f9fafb;
    }

    /* INPUT */
    input, select {
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        width: 100%;
        margin-top: 5px;
    }

    /* LOGOUT */
    .logout-btn {
        margin-top: 20px;
        width: 100%;
    }
</style>
```

</head>

<body>

```
<div class="sidebar">
    <h2>🏪 Toko Indonesia</h2>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.barang.index') }}" class="{{ request()->is('admin/barang*') ? 'active' : '' }}">🛒 Barang</a>
            <a href="{{ route('admin.kategori.index') }}" class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">📂 Kategori</a>
            <a href="{{ route('admin.supplier.index') }}" class="{{ request()->is('admin/supplier*') ? 'active' : '' }}">🚚 Supplier</a>
            <a href="{{ route('admin.gerai.index') }}" class="{{ request()->is('admin/gerai*') ? 'active' : '' }}">🏬 Gerai</a>
            <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">📄 Transaksi</a>
            <a href="{{ route('admin.distribusi.index') }}" class="{{ request()->is('admin/distribusi*') ? 'active' : '' }}">🚚 Distribusi</a>
        @elseif(auth()->user()->role === 'gudang')
            <a href="{{ route('gudang.barang.index') }}" class="{{ request()->is('gudang') ? 'active' : '' }}">📦 Gudang</a>
            <a href="{{ route('gudang.distribusi.index') }}" class="{{ request()->is('gudang/distribusi*') ? 'active' : '' }}">🚚 Distribusi</a>
        @elseif(auth()->user()->role === 'gerai')
            <a href="{{ route('gerai.transaksi.index') }}" class="{{ request()->is('gerai/transaksi*') ? 'active' : '' }}">🛒 Request Barang</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger logout-btn">Logout</button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">🔐 Login</a>
    @endguest
</div>

<div class="content">
    @yield('content')
</div>
```

</body>
</html>
