<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    ], function () {

        Auth::routes();


        Route::get('/dashboard/user', function () {
            return view('Dashboard.users.dashboard');
        })->middleware(['auth'])->name('dashboard/user');

        Route::get('/dashboard/admin', function () {
            return view('Dashboard.admins.dashboard');
        })->middleware(['auth:admin'])->name('dashboard/admin');

        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctors.dashboard');
        })->middleware(['auth:doctor'])->name('/dashboard/doctor');

        Route::get('/dashboard/employee', function () {
            return view('Dashboard.employee_dashboard.dashboard');
        })->middleware(['auth:employee'])->name('/dashboard/employee');

        Route::get('/dashboard/patient', function () {
            return view('Dashboard.patient_dashboard.dashboard');
        })->middleware(['auth:patient'])->name('dashboard/patient');

        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');

    });