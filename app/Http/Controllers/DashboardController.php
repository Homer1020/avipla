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
    public function index() {
        function obtenerIncrementoEnMes($model) {
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

        if(!request()->user()->roles()->where('name', 'afiliado')->exists()) {
            $fechaActual = Carbon::now();
            $nombreMes = $fechaActual->translatedFormat('F');
            $anio = $fechaActual->format('Y');
            $currentCodigoAviso = strtoupper($nombreMes) . $anio;

            $afiliados = Afiliado::all();
            $afiliadosMorosos = Afiliado::whereHas('avisosCobros', function (Builder $query) use ($currentCodigoAviso) {
                    $query
                        ->where('estado', '!=', 'CONCILIADO')
                        ->where('codigo_aviso', '!=', $currentCodigoAviso);
                })
                ->count();

            $afiliadosAlDia = Afiliado::whereHas('avisosCobros', function (Builder $query) {
                    $query
                        ->where('estado', 'CONCILIADO');
                })
                ->count();
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
                'porcentaje'    => obtenerIncrementoEnMes(Afiliado::class)
            ];

            $data['boletines'] = [
                'cantidad'      => Boletine::count(),
                'porcentaje'    => obtenerIncrementoEnMes(Boletine::class)
            ];

            $data['noticias'] = [
                'cantidad'      => Noticia::count(),
                'porcentaje'    => obtenerIncrementoEnMes(Noticia::class)
            ];

            $avisosCobrosAgrupados = json_encode(AvisoCobro::all()->groupBy('codigo_aviso'));
            $avisosCobrosEstados = AvisoCobro::all()->groupBy('estado');


            return view('dashboard.index', compact(
                'currentCodigoAviso',
                'avisosCobrosPorPagar',
                'data',
                'avisosCobrosAgrupados',
                'avisosCobrosEstados'
            ));
        } else {
            $recibosall = AvisoCobro::where('afiliado_id', request()->user()->afiliado->id)->get();
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
}
