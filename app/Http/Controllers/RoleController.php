<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNot('name', 'afiliado')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = new Role();
        $permissionsGroup = Permission::all()->groupBy(function($action) {
            $actionArray = explode('_', $action->name);
            $suffix = $actionArray[1];
            if(count($actionArray) === 3) {
                return $actionArray[1] . ' ' . $actionArray[2];
            }
            return $suffix;
        });
        return view('roles.create', compact('permissionsGroup', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->role
        ]);
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('roles.index')->with('success', 'El role fué creado con exíto.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if($role->name === 'afiliado') return abort(403);
        $permissionsGroup = Permission::all()->groupBy(function($action) {
            $actionArray = explode('_', $action->name);
            $suffix = $actionArray[1];
            if(count($actionArray) === 3) {
                return $actionArray[1] . ' ' . $actionArray[2];
            }
            return $suffix;
        });
        return view('roles.edit', compact('permissionsGroup', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->input('permissions'));
        return redirect()->route('roles.index')->with('success', 'El role fué actualizado con exíto.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Se eliminó el rol correctamente.');
    }
}
