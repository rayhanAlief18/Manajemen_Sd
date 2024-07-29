<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckClassId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('guru')->check() || Auth::guard('waliMurid')->check()) {

            // Ambil ID kelas dari URL
            $classIdFromUrl = Auth::guard('waliMurid')->user()->kelas_id; // Sesuaikan dengan parameter di route Anda
            $classIdFromUrls = $request->route('id');
            // Ambil ID kelas dari sesi
            $classIdFromSession = Auth::guard('waliMurid')->user()->kelas_id; // Sesuaikan dengan nama sesi Anda
            dd($classIdFromUrl,$classIdFromSession,$classIdFromUrls);

            // Cek apakah ID kelas dari URL sesuai dengan ID kelas dari sesi
            if ($classIdFromUrl != $classIdFromSession) {
                // Jika tidak sesuai, kembalikan respon error atau redirect
                // return redirect('/unauthorized'); // Atau Anda bisa mengganti dengan respon lain yang sesuai
                dd($classIdFromUrl,$classIdFromSession);
            }

            return $next($request);
        }
    }
}
