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

Route::middleware(['auth'])->group(function () {
    
//    1. Rute yang HANYA bisa diakses setelah LOGIN
//  Halaman Root (/) sekarang berfungsi sebagai Dashboard
    Route::get('/', function () {
        return view('dashboard', [
            'title' => 'Beranda',
            'name' => auth()->user()->name // Ambil nama asli dari DB
        ]);
    })->name('/');

    Route::get('schedule', function (){
        return view('schedule', [
            'title' => 'Jadwal Ujian',
            'name' => auth()->user()->name // Ambil nama asli dari DB
        ]);
    });

    Route::get('testResults', function (){
        return view('testResults', [
            'title' => 'Hasil Ujian',
            'name' => auth()->user()->name,
            'grades' => Result::all()
        ]);
    });

    Route::get('settings', function (){
        return view('settings', [
            'title' => 'Pengaturan', 
            'name' => auth()->user()->name
        ]);
    });

    // Di web.php ubah menjadi POST
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// 2. Rute Autentikasi (Bisa diakses tanpa login)
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});