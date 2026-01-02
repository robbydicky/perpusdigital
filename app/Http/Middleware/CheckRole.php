<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        // Cek apakah role user sesuai dengan yang diminta route
        if (Auth::user()->role !== $role) {
            // Jika user coba masuk halaman admin, tendang ke dashboard user
            if ($role == 'admin') {
                return redirect('/dashboard'); 
            }
            // Jika admin coba masuk halaman user (opsional), biarkan atau redirect
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}