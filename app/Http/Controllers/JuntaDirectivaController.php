<?php

namespace App\Http\Controllers;

use App\Models\JuntaDirectiva;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JuntaDirectivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'junta_directiva_role_id'   => 'required',
            'nombre'                    => 'required'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        $juntaDirectiva = JuntaDirectiva::create($payload);

        return response()->json([
            'success'   => true,
            'message'   => 'Persona agregada correctamente',
            'data'      => $juntaDirectiva
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(JuntaDirectiva $juntaDirectiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JuntaDirectiva $juntaDirectiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JuntaDirectiva $juntaDirectiva)
    {
        $validator = Validator::make($request->all(), [
            'junta_directiva_role_id'   => 'required',
            'nombre'                    => 'required'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        $juntaDirectiva->update($payload);

        $juntaDirectiva->load('role');

        return response()->json([
            'success'   => true,
            'message'   => 'Imágen actualizada correctamente',
            'data'      => $juntaDirectiva
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JuntaDirectiva $juntaDirectiva)
    {
        $juntaDirectiva->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Se eliminó este registro'
        ]);
    }
}
