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
    public function index() {
        $solicitudes = SolicitudAfiliado::latest()->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create() {
        $this->authorize('requestForm', SolicitudAfiliado::class);
        return view('solicitudes.create');
    }

    public function store(Request $request) {
        $this->authorize('request', SolicitudAfiliado::class);
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'correo'        => 'required|email|unique:solicitudes_afiliados,correo'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $solicitud = SolicitudAfiliado::create($payload);

        Mail::to($request->input('correo'))->send(new VerifyAfiliadoEmail($solicitud));

        return redirect()->route('solicitudes.index')->with('success', 'Se envio un correo de acceso.');
    }

    public function reminder(SolicitudAfiliado $solicitud) {
        $this->authorize('reminder', SolicitudAfiliado::class);
        Mail::to($solicitud->correo)->send(new AfiliadoEmailReminder($solicitud));
        return redirect()->route('solicitudes.index')->with('success', 'Correo enviado correctamente.');
    }
}
