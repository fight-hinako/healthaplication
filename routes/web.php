<?php

use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkCountController;

Route::view('/', 'welcome')->name('welcome');


Route::get('/createaccount', [CreateAccountController::class, 'create'])->name('createaccount');
Route::post('/createaccount/submit', [CreateAccountController::class, 'store'])->name('createaccount.submit');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'store'])->name('login.submit');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'show'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');
});