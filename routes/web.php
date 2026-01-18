<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ResultController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard (Redirect by Role)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', function () {
        return view('profile.index');
    })->name('profile');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class);

        Route::get('/admin/users', function () {
            return view('admin.users.index');
        })->name('admin.users');

    });

    /*
    |--------------------------------------------------------------------------
    | Guru Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:guru'])->group(function () {

        Route::resource('questions', QuestionController::class);
        Route::resource('exams', ExamController::class);

        Route::get('/exams/{exam}/results', [ResultController::class, 'index'])
            ->name('exams.results');

    });

    /*
    |--------------------------------------------------------------------------
    | Siswa Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:siswa'])->group(function () {

        Route::get('/my-exams', [ExamController::class, 'myExams'])
            ->name('siswa.exams');

        Route::get('/exams/{exam}/start', [ParticipantController::class, 'start'])
            ->name('exam.start');

        Route::post('/exams/{exam}/submit', [ParticipantController::class, 'submit'])
            ->name('exam.submit');

    });

    /*
    |--------------------------------------------------------------------------
    | Pimpinan Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:pimpinan'])->group(function () {

        Route::get('/reports', [ResultController::class, 'reports'])
            ->name('reports.index');

    });

});
