<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\AvisoCobro;
use App\Models\Banco;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\User;
use App\Notifications\AvisoCobroPaid;
use App\Notifications\PayUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Pago::class, 'pago');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avisosCobros = AvisoCobro::with('afiliado')
            ->whereHas('afiliado', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->latest()->get();
        return view('pagos.index', compact('avisosCobros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePagoRequest $request)
    {
        $payload = $request->validated();

        $comprobanteFile = $request->file('comprobante');
        $comprobanteFileName = $comprobanteFile->hashName();
        $comprobanteFile->storeAs('comprobantes', $comprobanteFileName);

        $payload['comprobante'] = $comprobanteFileName;

        $avisoCobro = AvisoCobro::where('id', $payload['aviso_cobro_id'])->first();

        Pago::create($payload);

        $avisoCobro->update([ 'estado' => 'REVISION' ]);

        $administradores = User::whereHas('roles', function ($query) {
            $query
                ->where('name', 'administrador')
                ->orWhere('name', 'usuario');
        })->get();
        foreach ($administradores as $administrador) {
            $administrador->notify(new AvisoCobroPaid($avisoCobro));
        }

        return redirect()->route('pagos.index')->with('success', 'Pago realizado correctamente.');
    }

    public function edit(Pago $pago) {
        $pago->load('avisoCobro');
        $metodos_pago = MetodoPago::all();
        $bancos = Banco::all();
        return view('pagos.edit', compact('pago', 'metodos_pago', 'bancos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $payload = $request->validated();

        if($request->hasFile('comprobante')) {
            Storage::delete('comprobantes/' . $pago->comprobante);
            $comprobanteFile = $request->file('comprobante');
            $comprobanteFileName = $comprobanteFile->hashName();
            $comprobanteFile->storeAs('comprobantes', $comprobanteFileName);

            $payload['comprobante'] = $comprobanteFileName;
        }

        $pago->update($payload);

        $pago->avisoCobro->update([ 'estado' => 'REVISION' ]);

        $administradores = User::whereHas('roles', function ($query) {
            $query->where('name', 'administrador')->orWhere('name', 'usuario');
        })
        ->get();

        foreach ($administradores as $administrador) {
            $administrador->notify(new PayUpdated($pago->avisoCobro));
        }

        return redirect()->route('pagos.index')->with('success', 'Se actualizó la información del pago correctamente.');
    }
}
