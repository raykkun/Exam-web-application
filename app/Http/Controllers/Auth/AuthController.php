<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Closure;
// use App\Http\Middleware\RoleMiddleware;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login', ['title' => 'Login']);
        // redirect()->intended('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        // dd($credentials);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'teacher' => redirect()->intended('/teacher/dashboard'),
                'student' => redirect()->intended('/student/dashboard'),
                default => redirect()->intended('dashboard'),
            };
           

            // return redirect()->intended('/');
        }

        return back()->withError('loginError', 'Login failed! Please check your credentials.');
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // public function index(): View
    // {
    //     return view('auth.login', ['title' => 'Login']);
    // }  
      
    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // public function registration(): View
    // {
    //     return view('auth.registration');
    // }
      
    //  public function postLogin(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
   
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Gunakan rute '/' atau nama rute 'dashboard'
    //         return redirect()->intended(route('/'))
    //                     ->withSuccess('You have Successfully loggedin');
    //     }
  
    //     return redirect("login")->with('error', 'Oppes! You have entered invalid credentials');
    // }
     
    // public function postRegistration(Request $request): RedirectResponse
    // {  
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);
           
    //     $user = $this->create($request->all());
            
    //     Auth::login($user); 

    //     // Redirect ke route '/' (dashboard)
    //     return redirect()->route('/')->withSuccess('Great! You have Successfully loggedin');
    // }
    
    // public function dashboard()
    // {
    //     // Pengecekan manual ini sebenarnya sudah di-handle oleh middleware 'auth' di web.php
    //     // Tapi jika ingin tetap ada, pastikan variabel dikirim ke view agar tidak error 'null'
    //     return view('dashboard', [
    //         'title' => 'Beranda',
    //         'user' => Auth::user()
    //     ]);
    // }
    
    
    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // public function create(array $data)
    // {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    // }
    
     public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        
        // Penting di Laravel: invalidate session & regenerate token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();
  
        return redirect('login');
    }
}
