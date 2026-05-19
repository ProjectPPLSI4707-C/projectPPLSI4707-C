<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            // Redirect ke dashboard sesuai role masing-masing
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('anggota.dashboard');
        }

        return $next($request);
    }
}
