<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    // 🔥 HALAMAN RESET
    public function create(): View
    {
        return view('auth.reset-password');
    }

    // 🔥 SIMPAN PASSWORD BARU
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = Auth::user();

        // 🔥 UPDATE PASSWORD
        $user->update([
            'password' => Hash::make($request->password),
            'is_first_login' => false,
            'password_default' => null,
        ]);

        // 🔥 OPTIONAL: logout biar login ulang pakai password baru
        Auth::logout();

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah, silakan login ulang');
    }
}