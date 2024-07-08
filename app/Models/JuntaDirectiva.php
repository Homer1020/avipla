<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuntaDirectiva extends Model
{
    use HasFactory;

    protected $fillable = ['junta_directiva_role_id', 'nombre'];

    public function role() {
        return $this->belongsTo(JuntaDirectivaRole::class, 'junta_directiva_role_id');
    }

    public $timestamps = false;
}
