<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function afiliado() {
        return $this->hasOne(Afiliado::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function boletin() {
        return $this->hasMany(Boletine::class);
    }

    public function is_admin(): bool {
        return $this->roles()->first()->name === 'administrador';
    }
}
