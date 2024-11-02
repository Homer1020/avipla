<?php

namespace App\Policies;

use App\Models\Afiliado;
use App\Models\SolicitudAfiliado;
use App\Models\User;

class AfiliadoPolicy
{
    public function before(User $user) {
        if($user->roles()->where('name', 'admin')->exists()){
            return true;
        }
        return null;
    }
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_afiliado');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Afiliado $afiliado): bool
    {
        return $user->can('view_afiliado');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_afiliado');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Afiliado $afiliado): bool
    {
        if($user->afiliado_id === $afiliado->id) {
            return true;
        }
        return $user->can('update_afiliado');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Afiliado $afiliado): bool
    {
        return $user->can('delete_afiliado');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Afiliado $afiliado): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Afiliado $afiliado): bool
    {
        return false;
    }

    public function viewTrash() {
        return false;
    }
}
