<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
         // Jika session 'login' tidak ada, arahkan ke halaman login
        if (!session('login')) {
            return redirect('/masuk')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
