<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user || trim(strtolower($user->role)) !== strtolower($role)) {
            return redirect('/'); // jangan redirect ke login
        }

        return $next($request);
    }
}