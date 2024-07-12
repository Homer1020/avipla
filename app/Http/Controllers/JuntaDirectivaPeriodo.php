<?php

namespace App\Http\Controllers;

use App\Models\AviplaInfo;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JuntaDirectivaPeriodo extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'junta_directiva_anio_inicio'   => 'required|numeric',
            'junta_directiva_anio_fin'      => 'required|numeric'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();
        
        $aviplaInfo = AviplaInfo::first();

        if(!$aviplaInfo) {
            AviplaInfo::create($payload);
        } else {
            $aviplaInfo->update($payload);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Periodo de junta directiva actualizado.',
            'data'      => $aviplaInfo
        ]);
    }
}
