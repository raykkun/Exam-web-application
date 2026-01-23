<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

/*
|---------------------------------------------------------------------------
| Guest Routes (belum login)
|---------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Register
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    // Login
    Route::get('login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('post-login', [AuthController::class, 'postLogin'])
        ->name('login.post');

    // // Forgot password
    // Route::get('forgot-password', [AuthController::class, 'create'])
    //     ->name('password.request');

    // Route::post('forgot-password', [AuthController::class, 'store'])
    //     ->name('password.email');

    // // Reset password
    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    //     ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    //     ->name('password.update');
});

/*
|---------------------------------------------------------------------------
| Authenticated Routes (sudah login)
|---------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Email verification
    Route::get('login', [AuthController::class, 'index'])
        ->name('login');

    // Route::get('verify-email/{id}/{hash}', AuthController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('email/verification-notification',
    //     [AuthController::class, 'store'])
    //     ->middleware('throttle:6,1')
    //     ->name('verification.send');

    // Confirm password
    Route::get('confirm-password', [AuthController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [AuthController::class, 'store']);

    // Logout
    Route::post('logout', [AuthController::class, 'destroy'])
        ->name('logout');
});
