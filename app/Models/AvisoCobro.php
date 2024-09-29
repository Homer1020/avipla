<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvisoCobro extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable, SoftDeletes;

    protected $fillable = [
        'afiliado_id',
        'monto_total',
        'estado',
        'codigo_aviso',
        'fecha_limite'
    ];

    protected $auditEvents = [
        'deleted',
        'updated',
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
