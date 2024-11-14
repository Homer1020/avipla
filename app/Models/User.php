<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, CanResetPassword, SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_afiliado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $auditEvents = [
        'deleted',
        'updated',
    ];
    
    public function afiliado() {
        return $this->belongsTo(Afiliado::class);
    }

    public function invoices() {
        return $this->hasOne(Invoice::class);
    }

    public function avisosCobros() {
        return $this->hasMany(AvisoCobro::class);
    }

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }
    
    public function boletin() {
        return $this->hasMany(Boletine::class);
    }

    public function is_admin(): bool {
        return $this->roles()->whereIn('name', ['administrador', 'usuarios'])->exists();
    }
}
