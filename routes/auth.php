<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return inertia('Auth/Login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.attempt');

    Route::get('/register', function () {
        return inertia('Auth/Register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    })->name('logout');

    Route::get('/settings/account', function () {
        return inertia('Auth/Settings/Account');
    })->name('settings.account');

    Route::post('/settings/account/name', [SettingsController::class, 'name'])->name('settings.account.name');
    Route::post('/settings/account/password', [SettingsController::class, 'password'])->name('settings.account.password');
    Route::delete('/settings/account/delete', [SettingsController::class, 'delete'])->name('settings.account.delete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
