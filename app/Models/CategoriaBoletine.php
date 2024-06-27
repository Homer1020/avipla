<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaBoletine extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name',
        'name'
    ];

    public function boletines() {
        return $this->hasMany(Boletine::class, 'category_id');
    }

    public $timestamps = false;
}
