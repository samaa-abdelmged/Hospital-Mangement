<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('patient')->check()) {
            return redirect(RouteServiceProvider::Patient);
        }

        if (auth()->guard('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN);
        }

        if (auth()->guard('doctor')->check()) {
            return redirect(RouteServiceProvider::DOCTOR);
        }

        if (auth()->guard('employee')->check()) {
            return redirect(RouteServiceProvider::Employee);
        }

        if (auth()->guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}