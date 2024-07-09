<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'pago_id',
        'aviso_cobro_id',
        'numero_factura',
        'codigo_factura',
        'invoice_path',
        'observaciones'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function avisoCobro() {
        return $this->belongsTo(AvisoCobro::class);
    }

    public function pago() {
        return $this->hasOne(Pago::class);
    }
}
