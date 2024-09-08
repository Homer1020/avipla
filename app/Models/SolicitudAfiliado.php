<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAfiliado extends Model
{
    use HasFactory;

    public $table = 'solicitudes_afiliados';

    protected $fillable = [
        'razon_social',
        'correo',
        'confirmation_code',
    ];

    public function afiliado() {
        return $this->belongsTo(Afiliado::class, 'afiliado_id')->withTrashed();;
    }
}
