<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\AvisoCobro;
use App\Models\MetodoPago;
use App\Models\User;
use App\Notifications\AvisoCobroCreated;
use App\Notifications\AvisoCobroStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AvisoCobroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avisosCobros = AvisoCobro::with('pago')->latest()->get();
        return view('avisos-cobro.index', compact('avisosCobros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $afiliados = Afiliado::all();
        return view('avisos-cobro.create', compact('afiliados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'afiliado_id'       => 'required|numeric|exists:afiliados,id',
            'monto_total'       => 'required|numeric',
            'numero_factura'    => 'required|numeric|unique:aviso_cobros,numero_factura',
            'fecha_limite'      => 'nullable|date_format:Y-m-d|after:today',
            'documento'         => 'required|file|mimes:pdf'
        ]);

        $codigo_factura = Str::random(32);

        $documentFile = $request->file('documento');
        $documentFileName = $documentFile->hashName();
        $documentFile->storeAs('avisos-cobros', $documentFileName);

        $payload['documento'] = $documentFileName;
        $payload['codigo_factura'] = $codigo_factura;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $avisoCobro = $user->avisosCobros()->create($payload);
            $avisoCobro->afiliado->user->notify(new AvisoCobroCreated($avisoCobro));
            return redirect()->route('avisos-cobro.index')->with('success', 'Se generó el aviso correctamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AvisoCobro $avisoCobro)
    {
        $avisoCobro->load(['user', 'afiliado', 'pago']);
        return view('avisos-cobro.show', compact('avisoCobro'));
    }

    public function payCollectionNotice(AvisoCobro $avisoCobro) {
        $metodos_pago = MetodoPago::all();
        return view('pagos.create', compact('avisoCobro', 'metodos_pago'));
    }

    public function avisoCobroDetails(AvisoCobro $avisoCobro) {
        return view('pagos.show', compact('avisoCobro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AvisoCobro $avisoCobro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AvisoCobro $avisoCobro)
    {
        $previous_state = $avisoCobro->estado;
        $avisoCobro->estado = $request->input('invoice_status');
        $avisoCobro->observaciones = $request->input('observaciones');
        $avisoCobro->save();

        # only notify if the state is diferent
        if($avisoCobro->estado !== $previous_state) {
            $administradores = User::whereHas('roles', function ($query) {
                $query->where('name', 'administrador');
            })
            ->where('id', '!=', $request->user()->id)
            ->get();
            foreach ($administradores as $administrador) {
                $administrador->notify(new AvisoCobroStatusChanged($avisoCobro));
            }
            $avisoCobro->afiliado->user->notify(new AvisoCobroStatusChanged($avisoCobro));
        }
        return redirect()->route('avisos-cobro.index', $avisoCobro)->with('success', 'Se actualizó el estado de la factura.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvisoCobro $avisoCobro)
    {
        //
    }
}
