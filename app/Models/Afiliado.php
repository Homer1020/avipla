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
        'direccion',
        'telefono',
        'correo',
        'estado',
        'confirmation_code',
        'confirmed',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
