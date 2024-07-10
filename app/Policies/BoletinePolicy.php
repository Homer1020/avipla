<?php

namespace App\Policies;

use App\Models\Boletine;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoletinePolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Boletine $boletine): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->first()->name === 'editor';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Boletine $boletine): bool
    {
        return $user->id === $boletine->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Boletine $boletine): bool
    {
        return $user->id === $boletine->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Boletine $boletine): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Boletine $boletine): bool
    {
        return false;
    }
}
