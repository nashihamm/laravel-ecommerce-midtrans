<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            // Simpan URL yang dimaksud sebelum login
            session(['url.intended' => request()->fullUrl()]); // Menyimpan URL lengkap yang dimaksud
            return redirect()->route('login');
        }
    
        // Dapatkan user
        $user = Auth::user();
    
        // Cek apakah role user sesuai
        if ($user->role !== $role) {
            // Jika role tidak sesuai, arahkan ke halaman role masing-masing
            if ($role == 'seller') {
                return redirect('/seller');
            } elseif ($role == 'customer') {
                return redirect('/customer');
            } else {
                return abort(403, 'Anda tidak punya akses.');
            }
        }
    
        return $next($request);
    }
    
}

