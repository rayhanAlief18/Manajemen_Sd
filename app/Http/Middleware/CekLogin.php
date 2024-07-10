<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLogin
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::check()) {
            // Check user's role or level of access
            if (Auth::user()->admin) {
                // Admin can access all routes
                return $next($request);
            } elseif (Auth::user()->guru) {
                // Guru can access specific routes related to their role
                return $this->handleGuruRoutes($request, $next);
            }
        }

        // Redirect or deny access if not authenticated or authorized
        return redirect('/login')->with('error', 'Unauthorized access.');
    }

    // Handle routes accessible by Guru
    protected function handleGuruRoutes($request, Closure $next)
    {
        $allowedRoutes = [
            '/jadwal',   // Example: Guru can access JadwalController
            '/absensi',  // Example: Guru can access AbsensiController
            '/nilai',    // Example: Guru can access NilaiController
            '/kelas',    // Example: Guru can access KelasController
            '/matapelajaran',    // Example: Guru can access MataPelajaranController
            // Add more routes as needed
        ];

        // Check if requested route is allowed for Guru
        if (in_array($request->path(), $allowedRoutes)) {
            return $next($request);
        }

        // Redirect or deny access if not allowed
        return redirect('/login')->with('error', 'Unauthorized access.');
    }

    
}
