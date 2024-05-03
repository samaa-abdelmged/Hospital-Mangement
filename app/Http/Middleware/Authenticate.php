<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        
        if ($request->is('dashboard/patient')) {
            return route('login/patient');
        }

        if ($request->is('dashboard/admin')) {
            return route('login/admin');
        }

        if ($request->is('dashboard/doctor')) {
            return route('login/doctor');
        }

        if ($request->is('dashboard/employee')) {
            return route('login/employee');
        }

        if ($request->is('dashboard/user')) {
            return route('login/user');
        }

        return null;

    }
}