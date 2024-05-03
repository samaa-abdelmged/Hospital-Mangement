<?php

use App\Http\Controllers\Dashboard_Patient\chat\ChatController;
use App\Http\Controllers\Dashboard_Patient\PatientController;
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

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/patient/update', $handle);
        });

        Route::middleware(['auth:patient'])->group(function () {

            //##################### patients route ################################
            Route::get('patient_invoices', [PatientController::class, 'invoices'])->name('patient_invoices');
            Route::get('patient_laboratories', [PatientController::class, 'laboratories'])->name('patient_laboratories');
            Route::get('patient_view_laboratories/{id}', [PatientController::class, 'viewLaboratories'])->name('patient_view_laboratories');
            Route::get('patient_rays', [PatientController::class, 'rays'])->name('patient_rays');
            Route::get('patient_view_rays/{id}', [PatientController::class, 'viewRays'])->name('patient_view_rays');
            Route::get('patient_payments', [PatientController::class, 'payments'])->name('patient_payments');
            //######################## end patients route ##############################
    
        });


        //############################# Chat route ######################################
        Route::group(['middleware' => ['auth:patient,doctor']], function () {
            Route::get('CreateChat', [ChatController::class, 'CallComponentCreateChat'])->name('CreateChat');
            Route::get('chats', [ChatController::class, 'CallComponentMain'])->name('chats');
        });
        //############################# end Chat route ######################################
    

    }
);