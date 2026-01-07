<?php

use Illuminate\Support\Facades\Route;

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

Route::get('results', function (){
    return view('results', ['title' => 'Hasil Ujian','name' => 'Budi santoso']);
});

Route::get('settings', function (){
    return view('settings', ['title' => 'Pengaturan', 'name' => 'Budi santoso']);
});
