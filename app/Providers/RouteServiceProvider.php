<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard/user';
    public const ADMIN = '/dashboard/admin';
    public const DOCTOR = '/dashboard/doctor';
    public const Employee = '/dashboard/employee';
    public const Patient = '/dashboard/patient';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/auth.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dashboard_doctor.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dashboard_employee.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dashboard_patient.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/dashboard_admin.php'));

        });

    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}