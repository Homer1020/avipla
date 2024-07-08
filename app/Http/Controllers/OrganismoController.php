<?php

namespace App\Http\Controllers;

use App\Models\Organismo;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganismoController extends Controller
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
            'razon_social'  => 'required',
            'logotipo'      => 'image|required'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        $path = $request->file('logotipo')->store('public/organismos');
        $payload['logotipo'] = $path;

        $organismo = Organismo::create($payload);

        return response()->json([
            'success'   => true,
            'message'   => 'Imágen agregada correctamente',
            'data'      => $organismo
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organismo $organismo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organismo $organismo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organismo $organismo)
    {
        $validator = Validator::make($request->all(), [
            'razon_social'  => 'required',
            'logotipo'      => 'image|nullable'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        if($request->hasFile('logotipo') && Storage::fileExists($organismo->logotipo)) {
            Storage::delete($organismo->logotipo);
            $path = $request->file('logotipo')->store('public/carousel');
            $payload['logotipo'] = $path;
        }

        $organismo->update($payload);

        return response()->json([
            'success'   => true,
            'message'   => 'Imágen actualizada correctamente',
            'data'      => $organismo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organismo $organismo)
    {
        if(Storage::fileExists($organismo->logotipo)) {
            Storage::delete($organismo->logotipo);
        }
        $organismo->delete();
        return response()->json([
            'success'   => true,
        ]);
    }
}
