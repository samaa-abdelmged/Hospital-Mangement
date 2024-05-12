<?php

use App\Http\Controllers\Dashboard_Employee\InvoiceController;
use App\Http\Controllers\Dashboard_Employee\InvoiceLaboratorieController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::middleware(['auth:employee'])->group(function () {

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);

            });

            //exceptions
            Route::get('/404', function () {
                return view('Dashboard.employee_dashboard.404');
            })->name('404');

            //Ray
            Route::resource('employee_invoices', InvoiceController::class);
            Route::get('employee_completed_invoices', [InvoiceController::class, 'completed_invoices'])->name('employee_completed_invoices');
            Route::get('view_rays/{id}', [InvoiceController::class, 'view_Rays'])->name('view_rays');

            //Laboratorie
            Route::resource('invoices_laboratorie_employee', InvoiceLaboratorieController::class);
            Route::get('completed_invoices', [InvoiceLaboratorieController::class, 'completed_invoices'])->name('completed_invoices');
            Route::get('view_laboratories/{id}', [InvoiceLaboratorieController::class, 'view_laboratories'])->name('view_laboratories');

        });

    }
);