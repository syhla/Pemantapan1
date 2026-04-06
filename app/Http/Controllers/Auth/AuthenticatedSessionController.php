<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // Tampilkan halaman login
    public function create(): View|RedirectResponse
    {
        // Jika user sudah login, redirect sesuai role
        if (Auth::check()) {
            $user = Auth::user();
            $role = trim(strtolower($user->role));

            if ($role === 'admin') return redirect()->route('admin.barang.index');
            if ($role === 'gudang') return redirect()->route('gudang.index');
            if ($role === 'gerai') return redirect()->route('gerai.transaksi.index');
        }

        return view('auth.login');
    }

    // Login
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $role = trim(strtolower($user->role));

        if ($role === 'admin') return redirect()->route('admin.barang.index');
        if ($role === 'gudang') return redirect()->route('gudang.index');
        if ($role === 'gerai') return redirect()->route('gerai.transaksi.index');

        abort(403);
    }

    // Logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}