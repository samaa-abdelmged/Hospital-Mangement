<?php
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\WebSite\WelcomeController;

/*
|--------------------------------------------------------------------------
| web Routes
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
            return Route::post('/livewire/web/update', $handle);
        });

        Route::get('/', function () {
            return view('welcome');
        })->name('/');


        Route::get('ShowDoctorTable', [WelcomeController::class, 'CallComponent'])->name('ShowDoctorTable');

        Route::get('ShowServices', [WelcomeController::class, 'ShowServices'])->name('ShowServices');

        Route::get('ShowDoctors', [WelcomeController::class, 'ShowDoctors'])->name('ShowDoctors');

        Route::get('ShowSections', [WelcomeController::class, 'ShowSections'])->name('ShowSections');


    }
);