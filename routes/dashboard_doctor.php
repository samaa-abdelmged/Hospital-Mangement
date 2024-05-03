<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\InvoiceController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard_Patient\chat\ChatController;

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
    ], function () {

        Route::middleware(['auth:doctor'])->group(function () {

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/doctor/update', $handle);

            });

            Route::resource('invoices', InvoiceController::class);

            Route::get('doctor_completed_invoices', [InvoiceController::class, 'completedInvoices'])->name('doctor_completed_invoices');

            Route::get('review_invoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');

            Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');

            Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('patient_details');

            Route::resource('Diagnostics', DiagnosticController::class);

            Route::resource('rays', RayController::class);

            Route::resource('Laboratories', LaboratorieController::class);
       });

    });