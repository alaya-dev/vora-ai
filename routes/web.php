<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|-------------------------
| ROUTES AUTHENTIFIÉES
|-------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |-------------------------
    | USER DASHBOARD
    |-------------------------
    */
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    /*
    |-------------------------
    | ADMIN DASHBOARD (PROTÉGÉ)
    |-------------------------
    */
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');

    /*
    |-------------------------
    | PROFILE
    |-------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';