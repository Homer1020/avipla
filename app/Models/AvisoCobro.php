<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AvisoCobro extends Model
{
    use HasFactory;

    protected $fillable = [
        'afiliado_id',
        'monto_total',
        'estado',
        'codigo_aviso',
        'fecha_limite'
    ];

    static function getCurrentCodigoAviso() {
        $fechaActual = Carbon::now();
        $nombreMes = $fechaActual->translatedFormat('F');
        $anio = $fechaActual->format('Y');
        $codigo_aviso = strtoupper($nombreMes) . $anio;
        return $codigo_aviso;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function afiliado() {
        return $this->belongsTo(Afiliado::class)->withTrashed();
    }

    public function pago() {
        return $this->hasOne(Pago::class);
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
