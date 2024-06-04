<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm() {
        return view('auth.register');
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        /**
         * VALIDATE DATA
         */
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ]);

        /**
         * AUTH USER
         */
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        /**
         * MANAGE ERROR
         */
        return back()->withErrors([
            'email' => 'Los datos no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }

    public function register() {

    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('auth.loginForm');
    }
}
