<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Mendukung lebih dari satu role, contoh pemakaian di route:
     *   ->middleware('role:admin')
     *   ->middleware('role:admin,operator')
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        | Safety net saja. Middleware ini biasanya sudah dipasang di dalam
        | group 'auth', tapi dicek ulang untuk jaga-jaga kalau suatu saat
        | dipakai di luar group tersebut.
        */

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user     = auth()->user();
        $userRole = $user->role;

        /*
        |--------------------------------------------------------------------------
        | ROLE SESUAI
        |--------------------------------------------------------------------------
        */

        if (in_array($userRole, $roles, true)) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK SESUAI TAPI VALID → redirect ke dashboard masing-masing
        |--------------------------------------------------------------------------
        */

        $dashboardRoute = $user->dashboardRoute();

        if ($dashboardRoute !== null) {
            return redirect()->route($dashboardRoute);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK VALID → paksa logout
        |--------------------------------------------------------------------------
        */

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('error', 'Role akun Anda tidak dikenali. Silakan hubungi administrator.');
    }
}