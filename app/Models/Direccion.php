<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    public $table = 'direcciones';

    protected $fillable = [
        'direccion_oficina',
        'ciudad_oficina',
        'telefono_oficina',
        'direccion_planta',
        'ciudad_planta',
        'telefono_planta'
    ];

    public $timestamps = false;
}
