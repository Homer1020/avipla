<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'rif',
        'pagina_web',
        'correo',
        'direccion',
        'telefono',
        'estado'
    ];
}
