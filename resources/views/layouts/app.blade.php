<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Indonesia</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR ─────────────────────────────────── */
        .sidebar {
            width: 230px;
            background: #4f46e5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }

        /* Brand */
        .sb-brand {
            padding: 22px 18px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sb-brand-icon {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            margin-bottom: 10px;
        }

        .sb-brand-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            line-height: 1.3;
        }

        .sb-brand-sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 2px;
        }

        /* Nav */
        .sb-nav {
            flex: 1;
            padding: 10px 10px;
            overflow-y: auto;
        }

        .sb-section {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.35);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 10px 6px;
        }

        .sb-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 13px;
            font-weight: 400;
            margin-bottom: 2px;
            transition: background 0.15s, color 0.15s;
        }

        .sb-nav a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sb-nav a.active {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            font-weight: 500;
        }

        .sb-nav a .nav-icon {
            font-size: 15px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sb-nav a .nav-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            margin-left: auto;
            flex-shrink: 0;
        }

        .sb-nav a.active .nav-dot {
            background: #a5b4fc;
        }

        /* Footer */
        .sb-footer {
            padding: 12px 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sb-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            margin-bottom: 8px;
        }

        .sb-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #818cf8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .sb-uname {
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            line-height: 1.2;
        }

        .sb-urole {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.4);
            text-transform: capitalize;
        }

        .btn-logout {
            width: 100%;
            padding: 8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            background: transparent;
            color: rgba(255, 255, 255, 0.55);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* ─── MAIN WRAPPER ────────────────────────────── */
        .main-wrapper {
            margin-left: 230px;
            display: flex;
            flex-direction: column;
            width: calc(100% - 230px);
            min-height: 100vh;
        }

        /* Top Bar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 28px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-left .page-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
        }

        .topbar-left .breadcrumb {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-badge {
            font-size: 11px;
            font-weight: 500;
            background: #ede9fe;
            color: #4c1d95;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* ─── CONTENT AREA ────────────────────────────── */
        .content {
            padding: 28px;
            flex: 1;
        }

        /* ─── CARD ────────────────────────────────────── */
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        /* ─── BUTTONS ─────────────────────────────────── */
        .btn {
            padding: 9px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            transition: opacity 0.15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn:hover { opacity: 0.87; }

        .btn-primary { background: #4f46e5; color: #fff; }
        .btn-danger  { background: #ef4444; color: #fff; }
        .btn-success { background: #22c55e; color: #fff; }
        .btn-sm { padding: 5px 10px; font-size: 12px; border-radius: 7px; }

        /* ─── TABLE ───────────────────────────────────── */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead {
            background: #fafafa;
        }

        th {
            padding: 10px 14px;
            text-align: left;
            font-weight: 500;
            font-size: 11px;
            color: #9ca3af;
            border-bottom: 1px solid #f3f4f6;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            white-space: nowrap;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background: #fafafa;
        }

        /* ─── FORMS ───────────────────────────────────── */
        input, select, textarea {
            padding: 9px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #111827;
            background: #fff;
            width: 100%;
            outline: none;
            transition: border-color 0.15s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #6366f1;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            display: block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        /* ─── ALERTS ──────────────────────────────────── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .alert-success { background: #dcfce7; color: #14532d; border: 1px solid #bbf7d0; }
        .alert-danger  { background: #fee2e2; color: #7f1d1d; border: 1px solid #fecaca; }
        .alert-warning { background: #fef3c7; color: #78350f; border: 1px solid #fde68a; }
    </style>
</head>

<body>

    {{-- ─── SIDEBAR ────────────────────────────────── --}}
    <div class="sidebar">

        {{-- Brand --}}
        <div class="sb-brand">
            <div class="sb-brand-icon">🏪</div>
            <div class="sb-brand-name">Toko Indonesia</div>
            <div class="sb-brand-sub">Management System</div>
        </div>

        {{-- Nav Links --}}
        <div class="sb-nav">
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="sb-section">Manajemen</div>
                    <a href="{{ route('admin.barang.index') }}"
                       class="{{ request()->is('admin/barang*') ? 'active' : '' }}">
                        <span class="nav-icon">🛒</span> Barang
                        @if(request()->is('admin/barang*'))<span class="nav-dot"></span>@endif
                    </a>
                    <a href="{{ route('admin.kategori.index') }}"
                       class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
                        <span class="nav-icon">📂</span> Kategori
                        @if(request()->is('admin/kategori*'))<span class="nav-dot"></span>@endif
                    </a>
                    <a href="{{ route('admin.supplier.index') }}"
                       class="{{ request()->is('admin/supplier*') ? 'active' : '' }}">
                        <span class="nav-icon">🏭</span> Supplier
                        @if(request()->is('admin/supplier*'))<span class="nav-dot"></span>@endif
                    </a>
                    <a href="{{ route('admin.gerai.index') }}"
                       class="{{ request()->is('admin/gerai*') ? 'active' : '' }}">
                        <span class="nav-icon">🏬</span> Gerai
                        @if(request()->is('admin/gerai*'))<span class="nav-dot"></span>@endif
                    </a>
                    <div class="sb-section">Operasional</div>
                    <a href="{{ route('admin.transaksi.index') }}"
                       class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                        <span class="nav-icon">📄</span> Transaksi
                        @if(request()->is('admin/transaksi*'))<span class="nav-dot"></span>@endif
                    </a>
                    <a href="{{ route('admin.distribusi.index') }}"
                       class="{{ request()->is('admin/distribusi*') ? 'active' : '' }}">
                        <span class="nav-icon">🚚</span> Distribusi
                        @if(request()->is('admin/distribusi*'))<span class="nav-dot"></span>@endif
                    </a>

                @elseif(auth()->user()->role === 'gudang')
                    <div class="sb-section">Gudang</div>
                    <a href="{{ route('gudang.barang.index') }}"
                       class="{{ request()->is('gudang') ? 'active' : '' }}">
                        <span class="nav-icon">📦</span> Stok Gudang
                        @if(request()->is('gudang'))<span class="nav-dot"></span>@endif
                    </a>
                    <a href="{{ route('gudang.distribusi.index') }}"
                       class="{{ request()->is('gudang/distribusi*') ? 'active' : '' }}">
                        <span class="nav-icon">🚚</span> Distribusi
                        @if(request()->is('gudang/distribusi*'))<span class="nav-dot"></span>@endif
                    </a>

                @elseif(auth()->user()->role === 'gerai')
                    <div class="sb-section">Gerai</div>
                    <a href="{{ route('gerai.transaksi.index') }}"
                       class="{{ request()->is('gerai/transaksi*') ? 'active' : '' }}">
                        <span class="nav-icon">🛒</span> Request Barang
                        @if(request()->is('gerai/transaksi*'))<span class="nav-dot"></span>@endif
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('login') }}">
                    <span class="nav-icon">🔐</span> Login
                </a>
            @endguest
        </div>

        {{-- Footer: User info + Logout --}}
        @auth
        <div class="sb-footer">
            <div class="sb-user">
                <div class="sb-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="sb-uname">{{ auth()->user()->name }}</div>
                    <div class="sb-urole">{{ auth()->user()->role }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        @endauth

    </div>{{-- end .sidebar --}}


    {{-- ─── MAIN ───────────────────────────────────── --}}
    <div class="main-wrapper">

        {{-- Top Bar --}}
        <div class="topbar">
            <div class="topbar-left">
                <div class="page-title">@yield('page-title', 'Dashboard')</div>
                <div class="breadcrumb">@yield('breadcrumb', 'Toko Indonesia')</div>
            </div>
            <div class="topbar-right">
                @auth
                <span class="topbar-badge">{{ ucfirst(auth()->user()->role) }}</span>
                @endauth
            </div>
        </div>

        {{-- Page Content --}}
        <div class="content">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            @yield('content')
        </div>

    </div>{{-- end .main-wrapper --}}

</body>
</html>