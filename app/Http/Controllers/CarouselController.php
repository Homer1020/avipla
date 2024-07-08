<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo'    => 'required',
            'imagen'    => 'image|required'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        $path = $request->file('imagen')->store('public/carousel');
        $payload['imagen'] = $path;

        $carousel = Carousel::create($payload);

        return response()->json([
            'success'   => true,
            'message'   => 'Imágen agregada correctamente',
            'data'      => $carousel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $validator = Validator::make($request->all(), [
            'titulo'    => 'required',
            'imagen'    => 'image|nullable'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();

        if($request->hasFile('imagen') && Storage::fileExists($carousel->imagen)) {
            Storage::delete($carousel->imagen);
            $path = $request->file('imagen')->store('public/carousel');
            $payload['imagen'] = $path;
        }

        $carousel->update($payload);

        return response()->json([
            'success'   => true,
            'message'   => 'Imágen actualizada correctamente',
            'data'      => $carousel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        if(Storage::fileExists($carousel->imagen)) {
            Storage::delete($carousel->imagen);
        }
        $carousel->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Se eliminó la imágen correctamente'
        ]);
    }
}
