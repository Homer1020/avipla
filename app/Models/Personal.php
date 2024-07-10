<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    public $table = 'personal';

    protected $fillable = [
        'correo_presidente',
        'correo_gerente_general',
        'correo_gerente_compras',
        'correo_gerente_marketing_ventas',
        'correo_gerente_planta',
        'correo_gerente_recursos_humanos',
        'correo_administrador',
        'correo_gerente_exportaciones',
        'correo_representante_avipla',
        'numero_encargado_ws'
    ];

    public $timestamps = false;
}
