<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvisoCobro extends Model
{
    use HasFactory;

    protected $fillable = [
        'afiliado_id',
        'monto_total',
        'documento',
        'numero_factura',
        'estado',
        'codigo_factura',
        'fecha_limite'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function afiliado() {
        return $this->belongsTo(Afiliado::class);
    }

    public function pago() {
        return $this->hasOne(Pago::class);
    }

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }
}
