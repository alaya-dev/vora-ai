<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| ROUTES AUTHENTIFIÉES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD REDIRECTOR
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN PANEL (PROTÉGÉ)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';