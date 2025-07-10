<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;

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

    Route::resource('roles', RoleController::class)->missing(function (Request $request) {
        return Redirect::route('admin.roles.index')->withErrors(["errors" => "Unable to find requested record."]);
    });

    Route::resource('permissions', PermissionController::class)->only(['index']);

    Route::resource('users', UserController::class)->missing(function (Request $request) {
        return Redirect::route('admin.users.index')->withErrors(["errors" => "Unable to find requested record."]);
    });

    Route::resource('countries', CountryController::class)->missing(function (Request $request) {
        return Redirect::route('admin.countries.index')->withErrors(["errors" => "Unable to find requested record."]);
    });

    Route::resource('states', StateController::class)->missing(function (Request $request) {
        return Redirect::route('admin.states.index')->withErrors(["errors" => "Unable to find requested record."]);
    });
});