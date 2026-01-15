<?php

use Illuminate\Support\Facades\Route;
use App\Models\Result;
use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Beranda',
        'name' => 'Budi santoso'
    ]);
});

Route::get('schedule', function (){
    return view('schedule', ['title' => 'Jadwal Ujian','name' => 'Budi santoso']);
});

Route::get('testResults', function (){
    return view('testResults',[
        'title' => 'Hasil Ujian',
        'name' => 'Budi santoso',
        'grades' => Result::all()
    ]);
});

Route::get('settings', function (){
    return view('settings', ['title' => 'Pengaturan', 'name' => 'Budi santoso']);
});


# Authentication Routes LOGIN LOGOUT REGISTER

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']) ->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');