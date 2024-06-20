<?php

namespace App\Http\Controllers;

use App\Mail\AfiliadoEmailReminder;
use App\Mail\VerifyAfiliadoEmail;
use App\Models\SolicitudAfiliado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SolicitudController extends Controller
{
    public function requestForm() {
        return view('afiliados.request');
    }

    public function request(Request $request) {
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'correo'        => 'required|email|unique:solicitudes_afiliados,correo'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $solicitud = SolicitudAfiliado::create($payload);

        Mail::to($request->input('correo'))->send(new VerifyAfiliadoEmail($solicitud));

        return redirect()->route('afiliados.index')->with('success', 'Se envio un correo de acceso.');
    }

    public function reminder(SolicitudAfiliado $solicitud) {
        Mail::to($solicitud->correo)->send(new AfiliadoEmailReminder($solicitud));
        return redirect()->route('afiliados.index')->with('success', 'Correo enviado correctamente.');
    }
}
