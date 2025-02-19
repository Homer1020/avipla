<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Afiliado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'razon_social',
        'rif',
        'anio_fundacion',
        'capital_social',
        'pagina_web',
        'actividad_id',
        'relacion_comercio_exterior',
        'correo',
        'confirmation_code',
        'siglas',
        'estado',
        'brand',
        'rif_path',
        'estado_financiero_path',
        'registro_mercantil_path'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function user() {
        return $this->hasOne(User::class)->where('tipo_afiliado', 0);
    }

    public function presidente() {
        return $this->hasOne(User::class)->where('tipo_afiliado', 1);
    }

    public function director() {
        return $this->hasOne(User::class)->where('tipo_afiliado', 2);
    }
    
    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function avisosCobros() {
        return $this->hasMany(AvisoCobro::class);
    }

    public function direccion() {
        return $this->hasOne(Direccion::class);
    }
    
    public function productos() {
        return $this->belongsToMany(Producto::class, 'linea_productos')->withPivot('produccion_total_mensual', 'porcentage_exportacion', 'mercado_exportacion');
    }

    public function materias_primas() {
        return $this->belongsToMany(MateriaPrima::class, 'afiliado_materias_primas');
    }

    public function servicios() {
        return $this->belongsToMany(Servicio::class, 'afiliados_servicios');
    }

    public function referencias() {
        return $this->belongsToMany(Afiliado::class, 'afiliado_referencias', 'afiliado_id', 'afiliado_referencia_id');
    }

    public function personal() {
        return $this->hasOne(Personal::class);
    }

    public function actividad() {
        return $this->belongsTo(Actividad::class, 'actividad_id');
    }
}
