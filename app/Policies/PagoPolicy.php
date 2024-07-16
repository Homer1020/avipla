<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\Pago;
use App\Models\User;

class PagoPolicy
{
    // public function before(User $user) {
    //     $user->load('roles', 'afiliado');
    //     if($user->roles()->where('name', 'administrador')->exists()){
    //         return true;
    //     }
    //     return null;
    // }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->where('name', 'afiliado')->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pago $pago): bool
    {
        return $user->afiliado()->where('id', $pago->avisoCobro->afiliado_id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->where('name', 'afiliado')->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pago $pago): bool
    {
        return $user->afiliado->id === $pago->avisoCobro->afiliado_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pago $pago): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pago $pago): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pago $pago): bool
    {
        return false;
    }
}
