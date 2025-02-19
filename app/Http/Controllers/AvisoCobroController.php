<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\AvisoCobro;
use App\Models\User;
use App\Notifications\AvisoCobroCreated;
use App\Notifications\AvisoCobroStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $afiliados      = Afiliado::withTrashed()->get();
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
            'codigo_aviso'      => 'required|string',
            'monto_total'       => 'required|numeric',
            'fecha_limite'      => 'nullable|date_format:Y-m-d|after:today',
            'afiliado_id'       => 'nullable|numeric|exists:afiliados,id'
        ]);

        $user = Auth::user();

        if (!($user instanceof User)) abort(400);

        if($request->input('afiliado_id')) {
            $existing = AvisoCobro::where('afiliado_id', $payload['afiliado_id'])
                ->where('codigo_aviso', $payload['codigo_aviso']);
            
            if($existing) {
                return redirect()->route('avisos-cobro.index')->with('error', 'El afiliado ya tiene un aviso de cobro asignado con ese codigo');
            }

            $user->avisosCobros()->create($payload);
            return redirect()->route('avisos-cobro.index')->with('success', 'Se generó el aviso correctamente');
        }

        $afiliados = Afiliado::whereDoesntHave('avisosCobros', function($query) use ($payload) {
            $query->where('codigo_aviso', $payload['codigo_aviso']);
        })
        // ->whereHas('users')
        ->get();

        // dd($afiliados);

        if($afiliados->count() === 0) {
            return redirect()->route('avisos-cobro.index')->with('error', 'No hay afiliados disponibles');
        }

        foreach($afiliados as $afiliado) {
            $payload['afiliado_id'] = $afiliado->id;
            $avisoCobro = $user->avisosCobros()->create($payload);
            

            foreach($afiliado->users as $afiliadoUser) { 
                $afiliadoUser->notify(new AvisoCobroCreated($avisoCobro));
            }
        }
        return redirect()->route('avisos-cobro.index')->with('success', 'Se generaron los avisos de cobro correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(AvisoCobro $avisoCobro)
    {
        $avisoCobro->load(['user', 'afiliado', 'pago']);
        return view('avisos-cobro.show', compact('avisoCobro'));
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
        if ($request->ajax()) {
            return response()->json([
                'ok'        => true,
                'title'     => '¡Datos actualizados correctamente!',
                'message'   => 'Se actualizó el estado de la factura a ' . $avisoCobro->estado . '.'
            ]);
        }
        return redirect()->back()->with('success', '¡Datos actualizados correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvisoCobro $avisoCobro)
    {
        $avisoCobro->delete();
        return response()->json([
            'ok'        => true,
            'title'     => '¡Consulta existosa!',
            'message'   => 'Se eliminó correctamente el avíso de cobro ' . $avisoCobro->codigo_aviso . '.'
        ]);
    }
    
    public function modalDetail(AvisoCobro $avisoCobro) {
        $this->authorize('view', $avisoCobro);
        $avisoCobro->load(['user', 'afiliado', 'pago']);
        return view('avisos-cobro.modal.show', compact('avisoCobro'))->render();
    }

    public function datatable() {
        $afiliado       = request()->input('afiliado');
        $estado         = request()->input('estado');
        $date_range     = request()->input('date_range');
        $queryAvisosCobros   = AvisoCobro::with(['pago', 'afiliado'])->latest();
        $authAfiliado = Auth::user()->afiliado;

        if ($afiliado || $authAfiliado) {
            $queryAvisosCobros->where('afiliado_id', @$authAfiliado->id ? $authAfiliado->id : $afiliado);
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

        return response()->json([
            'data' => $avisosCobros->map(function($item) use ($authAfiliado) {
                return [
                    'id' => $item->id,
                    'codigo_aviso' => $item->codigo_aviso,
                    'created_at' => $item->created_at->diffForHumans(),
                    'afiliado_id' => $item->afiliado->razon_social,
                    'estado' => view('partials.invoice_status', ['avisoCobro' => $item])->render(),
                    'monto_total' => $item->monto_total . '$',
                    'actions' => $authAfiliado
                        ? view('avisos-cobro.table.afiliado-actions', ['avisoCobro' => $item])->render()
                        : view('avisos-cobro.table.actions', ['avisoCobro' => $item])->render()
                ];
            })
        ]);
    }
}
