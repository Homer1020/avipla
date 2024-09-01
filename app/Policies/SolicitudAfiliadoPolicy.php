<?php

namespace App\Policies;

use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudAfiliadoPolicy
{
    public function before(User $user) {
        $user->load('roles');
        if($user->roles()->where('name', 'administrador')->orWhere('name', 'usuario')->exists()){
            return true;
        }
        return null;
    }

    public function viewAny() {
        return false;
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

    public function delete()
    {
       return false;
    }
}
