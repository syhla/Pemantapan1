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
    // =========================
    // TAMPILKAN LOGIN
    // =========================
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login');
    }

    // =========================
    // LOGIN
    // =========================
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 HANYA GERAI YANG WAJIB GANTI PASSWORD
        if ($user->role === 'gerai' && $user->is_first_login) {
            return redirect()->route('password.reset');
        }

        return $this->redirectByRole($user);
    }

    // =========================
    // LOGOUT
    // =========================
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // =========================
    // REDIRECT ROLE
    // =========================
    private function redirectByRole($user): RedirectResponse
    {
        $role = strtolower(trim($user->role));

        return match ($role) {
            'admin' => redirect()->route('admin.barang.index'),
            'gudang' => redirect()->route('gudang.barang.index'),
            'gerai' => redirect()->route('gerai.transaksi.index'),
            default => abort(403),
        };
    }
}