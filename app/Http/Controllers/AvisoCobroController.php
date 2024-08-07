<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\AvisoCobro;
use App\Models\Banco;
use App\Models\MetodoPago;
use App\Models\User;
use App\Notifications\AvisoCobroCreated;
use App\Notifications\AvisoCobroStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AvisoCobroController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AvisoCobro::class, 'aviso_cobro');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $afiliados      = Afiliado::all();
        $afiliado       = request()->input('afiliado');
        $estado         = request()->input('estado');
        $date_range     = request()->input('date_range');
        $queryAvisosCobros   = AvisoCobro::with('pago')->latest();

        if ($afiliado) {
            $queryAvisosCobros->where('afiliado_id', $afiliado);
        }
    
        if ($estado) {
            $queryAvisosCobros->where('estado', $estado);
            
        }

        if ($date_range) {
            $dates = explode(' - ', $date_range);
            if (count($dates) == 2) {
                $startDate = $this->convertDateFormat($dates[0]);
                $endDate = $this->convertDateFormat($dates[1]);
                $queryAvisosCobros->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        $avisosCobros = $queryAvisosCobros->get();

        return view('avisos-cobro.index', compact('avisosCobros', 'afiliados'));
    }

    private function convertDateFormat($date)
    {
        $dateObj = \DateTime::createFromFormat('Y/m/d', $date);
        return $dateObj ? $dateObj->format('Y-m-d') : null;
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
            'monto_total'       => 'required|numeric',
            'fecha_limite'      => 'nullable|date_format:Y-m-d|after:today',
        ]);

        $fechaActual = Carbon::now();
        $nombreMes = $fechaActual->translatedFormat('F');
        $anio = $fechaActual->format('Y');
        $codigo_aviso = strtoupper($nombreMes) . $anio;

        $payload['codigo_aviso'] = $codigo_aviso;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $afiliados = Afiliado::all();

            foreach($afiliados as $afiliado) {
                if(!$afiliado->avisosCobros()->where('codigo_aviso', $codigo_aviso)->exists()) {
                    $payload['afiliado_id'] = $afiliado->id;
                    $avisoCobro = $user->avisosCobros()->create($payload);
                    $afiliado->user->notify(new AvisoCobroCreated($avisoCobro));
                    if($afiliado->presidente) {
                        $afiliado->presidente->notify(new AvisoCobroCreated($avisoCobro));
                    }
                    if($afiliado->director) {
                        $afiliado->director->notify(new AvisoCobroCreated($avisoCobro));
                    }
                }
            }
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
        $this->authorize('view', $avisoCobro);
        $metodos_pago = MetodoPago::all();
        $bancos = Banco::all();
        return view('pagos.create', compact('avisoCobro', 'metodos_pago', 'bancos'));
    }

    public function avisoCobroDetails(AvisoCobro $avisoCobro) {
        $this->authorize('view', $avisoCobro);
        return view('pagos.show', compact('avisoCobro'));
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
                $query->whereIn('name', ['administrador', 'usuarios']);
            })
            ->where('id', '!=', $request->user()->id)
            ->get();
            foreach ($administradores as $administrador) {
                $administrador->notify(new AvisoCobroStatusChanged($avisoCobro));
            }
            $avisoCobro->afiliado->user->notify(new AvisoCobroStatusChanged($avisoCobro));
            if($avisoCobro->afiliado->presidente) {
                $avisoCobro->afiliado->presidente->notify(new AvisoCobroStatusChanged($avisoCobro));
            }
            if($avisoCobro->afiliado->director) {
                $avisoCobro->afiliado->director->notify(new AvisoCobroStatusChanged($avisoCobro));
            }
        }
        $queryParams = $request->query();
        $url = route('avisos-cobro.index') . '?' . http_build_query($queryParams);
        return redirect($url)->with('success', 'Se actualizó el estado de la factura.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvisoCobro $avisoCobro)
    {
        //
    }
}
