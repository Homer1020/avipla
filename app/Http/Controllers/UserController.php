<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->where('id', '!=', request()->user()->id)->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $roles = Role::where('name', '!=', 'afiliado')->get();
        return view('users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
            'role_id'   => 'required|exists:roles,id'
        ]);

        $user = User::create($payload);

        $user->roles()->sync([$payload['role_id']]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::where('name', '!=', 'afiliado')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $payload = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:8|confirmed',
            'role_id'   => 'required|exists:roles,id'
        ]);


        $user->name = $payload['name'];
        $user->email = $payload['email'];

        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

         $user->roles()->sync([$payload['role_id']]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'Se actualizó el usuario correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Se eliminó el perfil correctamente.');         
    }
}
