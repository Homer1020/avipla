<?php

namespace App\Policies;

use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudAfiliadoPolicy
{
    public function before(User $user) {
        if($user->roles()->first()->name === 'administrador'){
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
