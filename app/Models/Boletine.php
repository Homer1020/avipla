<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Boletine extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'titulo',
        'contenido',
        'category_id',
        'slug'
    ];

    protected $auditEvents = [
        'created',
        'deleted',
        'updated',
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
