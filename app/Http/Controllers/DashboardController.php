<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\AvisoCobro;
use App\Models\Boletine;
use App\Models\Noticia;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function obtenerIncrementoEnMes($model) {
        // Obtener el número de registros del mes actual
        $registros_mes_actual = $model::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Obtener el número de registros del mes anterior
        $registros_mes_anterior = $model::whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', now()->subMonth()->year)
                ->count();

        // Calcular el porcentaje de cambio
        if ($registros_mes_anterior != 0) {
            $porcentaje_cambio = (($registros_mes_actual - $registros_mes_anterior) / $registros_mes_anterior) * 100;
        } else {
            $porcentaje_cambio = 0; // Por ejemplo, considerar un 100% de cambio si no hay registros el mes anterior
        }
        return $porcentaje_cambio;
    }

    public function index() {
        $user = request()->user();
        if($user->roles()->where('name', 'afiliado')->exists()) {
            return $this->afiliado();
        } {
            return $this->administrator();
        }
    }

    public function administrator() {
        $user = request()->user();
        $fechaActual = Carbon::now();
        $nombreMes = $fechaActual->translatedFormat('F');
        $anio = $fechaActual->format('Y');
        $currentCodigoAviso = strtoupper($nombreMes) . $anio;

        $afiliados = Afiliado::all();
        $afiliadosMorosos = Afiliado::whereHas('avisosCobros', function (Builder $query) use ($currentCodigoAviso) {
                $query
                    ->where('estado', '!=', 'CONCILIADO')
                    ->whereIn('codigo_aviso', [$currentCodigoAviso]);
            })
            ->count();

        $afiliadosAlDia = Afiliado::whereDoesntHave('avisosCobros', function (Builder $query) {
                $query
                    ->where('estado', '<>', 'CONCILIADO');
            })
            ->count();


        $afiliadosMorososTotales = Afiliado::with(['avisosCobros' => function ($query) {
                $query->where('estado', '!=', 'conciliado');
            }])
            ->whereHas('avisosCobros', function($query) {
                $query->where('estado', '!=', 'conciliado');
            })
            ->withCount(['avisosCobros as avisosMorosos' => function ($query) {
                $query->where('estado', '!=', 'conciliado');
            }])
            ->get();

        $afiliadosAlDiaTotales = Afiliado::with(['avisosCobros' => function ($query) {
            $query->where('estado', 'conciliado');
        }])
        ->whereDoesntHave('avisosCobros', function($query) {
            $query->where('estado', '<>', 'conciliado');
        })
        ->withCount(['avisosCobros as avisosMorosos' => function ($query) {
            $query->where('estado', 'conciliado');
        }])
        ->get();


        $avisosCobrosPorPagar = AvisoCobro::where('estado', '!=', 'CONCILIADO')->get();

        $totalAfiliados = $afiliados->count();     

        $data['afiliados_morosos'] = [
            'cantidad'      => $afiliadosMorosos,
            'porcentaje'    => ($afiliadosMorosos / $totalAfiliados) * 100
        ];

        $data['afiliados_al_dia'] = [
            'cantidad'      => $afiliadosAlDia,
            'porcentaje'    => ($afiliadosAlDia / $totalAfiliados) * 100
        ];

        $data['afiliados'] = [
            'cantidad'      => $totalAfiliados,
            'porcentaje'    => $this->obtenerIncrementoEnMes(Afiliado::class)
        ];

        $data['boletines'] = [
            'cantidad'      => Boletine::count(),
            'porcentaje'    => $this->obtenerIncrementoEnMes(Boletine::class),
            'propios'       => Boletine::where('user_id', $user->id)->count(),
        ];

        $data['noticias'] = [
            'cantidad'      => Noticia::count(),
            'porcentaje'    => $this->obtenerIncrementoEnMes(Noticia::class),
            'propios'       => Noticia::where('user_id', $user->id)->count(),
        ];

        $avisosCobrosAgrupados = json_encode(AvisoCobro::all()->groupBy('codigo_aviso'));
        $avisosCobrosEstados = AvisoCobro::all()->groupBy('estado');


        return view('dashboard.index', compact(
            'currentCodigoAviso',
            'avisosCobrosPorPagar',
            'data',
            'avisosCobrosAgrupados',
            'avisosCobrosEstados',
            'afiliadosMorososTotales',
            'afiliadosAlDiaTotales'
        ));
    }

    public function afiliado() {
        $afiliado = optional(request()->user()->afiliado)->first()
            ?? optional(request()->user()->afiliadoPresidente)->first()
            ?? optional(request()->user()->afiliadoDirector)->first();
        $recibosall = AvisoCobro::where('afiliado_id', $afiliado->id)->get();
        $data = [
            'recibos' => [
                'total'     => $recibosall->count(),
                'pagados'   => $recibosall->where('estado', 'CONCILIADO')->count(),
                'mora'      => $recibosall->filter(function ($item) {
                                    return $item->estado != 'CONCILIADO' && $item->estado != 'REVISION';
                                })->count()
            ]
        ];
        $recibosPorEstado = $recibosall->groupBy('estado');
        return view('dashboard.afiliado', compact('data', 'recibosPorEstado'));
    }
}
