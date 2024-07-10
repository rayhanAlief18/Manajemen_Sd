<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProtectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (Auth::guard('guru')->check()) {
            // Check if the authenticated user has a specific 'level'
            if (Auth::guard('guru')->user()->level == 'tata usaha' || Auth::guard('guru')->user()->level == 'wali kelas') {
                return $next($request);
            }
        }

        // If not authenticated or not authorized, redirect to login page
        return redirect('/')->with('error', 'Silahkan login terlebih dahulu');;
    }
}
