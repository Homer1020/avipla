<?php

namespace App\Policies;

use App\Models\CategoriaBoletine;
use App\Models\User;

class CategoriaBoletinePolicy
{
    public function before(User $user) {
        $user->load(['roles']);
        if($user->roles()->where('name', 'administrador')->orWhere('name', 'editor')->exists()){
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
    public function view(User $user, CategoriaBoletine $category): bool
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
    public function update(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return false;
    }
}
