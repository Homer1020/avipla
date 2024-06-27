<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boletine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titulo',
        'contenido',
        'category_id',
        'slug'
    ];

    public function categoria() {
        return $this->belongsTo(CategoriaBoletine::class, 'category_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
