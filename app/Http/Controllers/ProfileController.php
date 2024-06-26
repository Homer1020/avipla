<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show() {
        $user = request()->user();
        $user->load(['afiliado', 'roles']);
        return view('profile.show', compact('user'));
    }

    public function update(Request $request) {
        $user = request()->user();

        $payload = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:8|confirmed'
        ]);


        $user->name = $payload['name'];
        $user->email = $payload['email'];

        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Se actualio el perfil correctamente.');
    }

    public function businessShow(Request $request) {
        $afiliado = $request->user()->afiliado;
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::where('id', '!=', $afiliado->id)->get();
        $afiliado->load([
            'direccion',
            'personal',
            'productos',
            'materias_primas',
            'servicios'
        ]);
        return view('profile.business', compact(
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }
}
