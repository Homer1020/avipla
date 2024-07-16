<?php

namespace App\Policies;

use App\Models\AvisoCobro;
use App\Models\User;

class AvisoCobroPolicy
{
    public function before(User $user) {
        $user->load(['roles', 'afiliado']);
        if($user->roles()->where('name', 'administrador')->exists()){
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->where('name', 'usuario')->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AvisoCobro $avisoCobro): bool
    {
        return $user->afiliado()->where('id', $avisoCobro->afiliado_id)->exists() || $user->roles()->where('name', 'usuario')->exists();
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
