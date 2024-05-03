<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\GroupInvoiceController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard_Employee\LaboratoryEmployeeController;
use App\Http\Controllers\Dashboard_Employee\RayEmployeeController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Appointments\AppointmentController;

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

        Route::middleware(['auth:admin'])->group(function () {

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);

            });

            Route::resource('Sections', SectionController::class);

            Route::resource('Doctors', DoctorController::class);

            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');

            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');

            Route::resource('Service', SingleServiceController::class);

            Route::resource('insurance', InsuranceController::class);

            Route::resource('Ambulance', AmbulanceController::class);

            Route::resource('Patients', PatientController::class);

            Route::get('Add_GroupServices', [SingleServiceController::class, 'CallGroupeServices'])->name('Add_GroupServices');

            Route::get('single_invoices', [SingleServiceController::class, 'CallComponent'])->name('single_invoices');

            Route::view('Print_single_invoices', 'livewire.SingleInvoices.print')->name('Print_single_invoices');

            Route::resource('Receipt', ReceiptAccountController::class);

            Route::resource('Payment', PaymentAccountController::class);

            Route::get('GroupInvoice', [GroupInvoiceController::class, 'CallComponent'])->name('GroupInvoice');

            Route::view('group_invoices_Print', 'livewire.GroupInvoices.print')->name('group_invoices_Print');

            Route::resource('ray_employee', RayEmployeeController::class);

            Route::resource('laboratorie_employee', LaboratoryEmployeeController::class);

            //############################# Appointment route ######################################
            Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::get('appointments/approval', [AppointmentController::class, 'index2'])->name('appointments.index2');
            Route::put('appointments/approval/{id}', [AppointmentController::class, 'approval'])->name('appointments.approval');
            Route::delete('appointments/destroy/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
            //############################# End Appointment route ######################################
    

        });

    }
);