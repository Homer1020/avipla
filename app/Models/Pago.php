<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'comprobante',
        'metodo_pago_id',
        'aviso_cobro_id',
        'monto',
        'referencia',
        'fecha_pago',
        'banco_id',
        'tasa'
    ];

    public function banco() {
        return $this->belongsTo(Banco::class);
    }

    public function metodo_pago() {
        return $this->belongsTo(MetodoPago::class);
    }

    public function avisoCobro() {
        return $this->belongsTo(AvisoCobro::class);
    }
}
