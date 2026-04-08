<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForceResetPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (
            $user &&
            $user->role === 'gerai' &&
            $user->is_first_login
        ) {
            // ❌ jangan redirect kalau sudah di halaman reset password
            if (
                !$request->routeIs('password.reset') &&
                !$request->routeIs('password.update') &&
                !$request->routeIs('logout')
            ) {
                return redirect()->route('password.reset', [
                    'token' => 'force-reset'
                ]);
            }
        }

        return $next($request);
    }
}