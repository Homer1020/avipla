<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    use HasFactory;
    public $table = 'materias_primas';
    protected $fillable = ['materia_prima'];
    public $timestamps = false;
}
