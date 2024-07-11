<?php

namespace App\Policies;

use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudAfiliadoPolicy
{
    public function before(User $user) {
        $user->load('roles');
        if($user->roles()->where('name', 'administrador')->exists()){
            return true;
        }
        return null;
    }

    public function requestForm() {
        return false;
    }

    public function request() {
        return false;
    }

    public function reminder() {
        return false;
    }
}
