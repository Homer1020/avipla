<?php

namespace App\Policies;

use App\Models\Afiliado;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AfiliadoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles->first()->name === 'administrador';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Afiliado $afiliado): bool
    {
        return $user->roles->first()->name === 'administrador' || ($user->afiliado && $user->afiliado->id === $afiliado->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Afiliado $afiliado): bool
    {
        return $user->roles->first()->name === 'administrador' || ($user->afiliado && $user->afiliado->id === $afiliado->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Afiliado $afiliado): bool
    {
        return $user->roles->first()->name === 'administrador' || ($user->afiliado && $user->afiliado->id === $afiliado->id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Afiliado $afiliado): bool
    {
        return $user->roles->first()->name === 'administrador' || ($user->afiliado && $user->afiliado->id === $afiliado->id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Afiliado $afiliado): bool
    {
        return $user->roles->first()->name === 'administrador' || ($user->afiliado && $user->afiliado->id === $afiliado->id);
    }
}
