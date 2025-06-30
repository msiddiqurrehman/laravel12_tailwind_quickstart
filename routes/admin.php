<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DesignationController;

Route::middleware('guest')->group(function () {
    Route::get('connect/administrator/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');
});

Route::middleware(['auth', 'verified', 'admin_auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::resource('modules', ModuleController::class)->missing(function (Request $request) {
        return Redirect::route('admin.modules.index')->withErrors(["errors" => "Unable to find requested record."]);
    });

    Route::resource('userTypes', UserTypeController::class)->missing(function (Request $request) {
        return Redirect::route('admin.userTypes.index')->withErrors(["errors" => "Unable to find requested record."]);
    });

    Route::resource('designations', DesignationController::class)->missing(function (Request $request) {
        return Redirect::route('admin.designations.index')->withErrors(["errors" => "Unable to find requested record."]);
    });
});