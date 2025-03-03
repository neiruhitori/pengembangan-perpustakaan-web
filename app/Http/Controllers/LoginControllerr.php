<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite

class LoginControllerr extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function register()
    {
        return view('login.register');
    }

    // Login
    public function loginuser(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        return redirect('/login')->with('error', 'Email atau password yang anda masukkan salah');
    }

    // Register
    public function registeruser(Request $request)
    {
        User::create([
            'perpustakaan_id' => $request->perpustakaan_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        return redirect('/login');
    }

    //    Logout
    public function logout(Request $request)
    {
        // Auth::logout();
        // return redirect('login');
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
