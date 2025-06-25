<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;

Route::middleware('guest')->group(function () {
    Route::get('connect/administrator/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');
});

Route::middleware(['auth', 'verified', 'admin_auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::resource('modules', ModuleController::class)->missing(function (Request $request) {
        return Redirect::route('modules.index');
    });
});