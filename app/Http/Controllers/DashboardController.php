<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // if(Auth::check()){
            return view('dashboard', [
                'title' => 'Beranda',
                'name' => auth()->user()->name // Ambil nama asli dari DB
            ]);
        // }
        // return redirect('login')->withsuccess('You are not allowed to access');
    }

    public function student(){
        return view('student.dashboard', [
            'title' => 'Dashboard Siswa',
            'name' => auth()->user()->name // Ambil nama asli dari DB
        ]);
    }
}
