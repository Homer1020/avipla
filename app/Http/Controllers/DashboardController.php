<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\AvisoCobro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $data = DB::table('aviso_cobros')
            ->join('afiliados', 'aviso_cobros.afiliado_id', '=', 'afiliados.id')
            ->where('aviso_cobros.estado', 'PENDIENTE')
            ->select('afiliados.razon_social', 'aviso_cobros.numero_factura')
            ->get();
        $avisosCobroPendientes = AvisoCobro::with('afiliado')->where('estado', 'PENDIENTE')->get();
        // return $avisosCobroPendientes;
        return view('dashboard.index', compact(
            'data',
            'avisosCobroPendientes'
        ));
    }
}
