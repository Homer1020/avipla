<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(string $confirmation_code = '') {
        $afiliado = new Afiliado();
        if($confirmation_code) {
            $afiliado = Afiliado::where('confirmation_code', $confirmation_code)->first();
        }
        return view('auth.register', compact('afiliado'));
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

            return redirect()->intended('dashboard')->with('success', 'Bienvenido ' . Auth::user()->name . '!');
        }

        /**
         * MANAGE ERROR
         */
        return back()->withErrors([
            'email' => 'Los datos no coinciden con nuestros registros.'
        ])->onlyInput('email');
    }

    public function register(Request $request) {
        $payload = $request->validate([
            'name'              => 'required|string',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:8|confirmed',
            'razon_social'      => 'required|string',
        ]);

        $confirmation_code = $request->input('confirmation_code');

        if($confirmation_code) {
            $afiliado = Afiliado::where('confirmation_code', $confirmation_code)->first();
            $payload['password'] = bcrypt($payload['password']);
            $user = User::create($request->only([
                'name',
                'email',
                'password'
            ]));
            $afiliado->user()->associate($user);
            $afiliado->update([
                'razon_social'      => $request->input('razon_social'),
                'confirmation_code' => null,
                'confirmed'         => true
            ]);
            return redirect()->route('auth.loginForm');
        } else {
            /**
             * MANEJAR ERROR
             */
        }
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('auth.loginForm');
    }
}
