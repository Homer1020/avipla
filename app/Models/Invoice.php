<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'afiliado_id',
        'monto_total',
        'documento',
        'numero_factura',
        'estado'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function afiliado() {
        return $this->belongsTo(Afiliado::class);
    }
}
