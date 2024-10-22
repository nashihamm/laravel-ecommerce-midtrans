<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        try {
            // Ambil pengguna yang diautentikasi
            $user = JWTAuth::parseToken()->authenticate();

            // Cek apakah pengguna memiliki role yang sesuai
            if ($user && $user->role === $role) {
                return $next($request);
            }

            return response()->json([
                'success' => false,
                'message' => 'Access denied: You do not have the correct role to access this resource',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided or invalid',
            ], 401);
        }
    }

}
