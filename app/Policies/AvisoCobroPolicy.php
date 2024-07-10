<?php

namespace App\Policies;

use App\Models\AvisoCobro;
use App\Models\User;

class AvisoCobroPolicy
{
    public function before(User $user) {
        if($user->roles()->first()->name === 'administrador'){
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AvisoCobro $avisoCobro): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AvisoCobro $avisoCobro): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AvisoCobro $avisoCobro): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AvisoCobro $avisoCobro): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AvisoCobro $avisoCobro): bool
    {
        return false;
    }
}
