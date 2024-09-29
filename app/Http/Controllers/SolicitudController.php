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
    public function __construct() {
        $this->authorizeResource(SolicitudAfiliado::class, 'solicitud');
    }

    public function index() {
        $solicitudes = SolicitudAfiliado::whereDoesntHave('afiliado')->latest()->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create() {
        return view('solicitudes.create');
    }

    public function store(Request $request) {
        $payload = $request->validate([
            'razon_social'  => 'required|string',
            'correo'        => 'required|email|unique:solicitudes_afiliados,correo'
        ]);

        $confirmation_code = Str::random(25);
        $payload['confirmation_code'] = $confirmation_code;

        $solicitud = SolicitudAfiliado::create($payload);

        Mail::to($request->input('correo'))->send(new VerifyAfiliadoEmail($solicitud));

        return redirect()->route('solicitudes.index')->with('success', 'Se envió un correo de acceso.');
    }

    public function destroy(SolicitudAfiliado $solicitud) {
        $solicitud->delete();
        return redirect()->route('solicitudes.index')->with('success', 'Se eliminó correctamente.');
    }

    public function reminder(SolicitudAfiliado $solicitud) {
        $this->authorize('reminder', SolicitudAfiliado::class);
        Mail::to($solicitud->correo)->send(new AfiliadoEmailReminder($solicitud));
        return redirect()->route('solicitudes.index')->with('success', 'Correo enviado correctamente.');
    }
}
