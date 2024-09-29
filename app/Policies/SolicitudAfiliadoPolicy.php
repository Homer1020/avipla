<?php

namespace App\Policies;

use App\Models\SolicitudAfiliado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudAfiliadoPolicy
{

    public function viewAny(User $user) {
        return $user->can('view_solicitud');
    }

    public function create(User $user) {
        return $user->can('create_solicitud');
    }

    public function delete(User $user)
    {
       return $user->can('delete_solicitud');
    }

    public function reminder() {
        return false;
    }
}
