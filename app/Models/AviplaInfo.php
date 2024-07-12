<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AviplaInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'junta_directiva_anio_inicio',
        'junta_directiva_anio_fin'
    ];

    public $timestamps = false;
}
