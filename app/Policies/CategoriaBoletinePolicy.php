<?php

namespace App\Policies;

use App\Models\CategoriaBoletine;
use App\Models\User;

class CategoriaBoletinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_category_boletine');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CategoriaBoletine $category): bool
    {
        return $user->can('view_category_boletine');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_category_boletine');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return $user->can('update_category_boletine');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CategoriaBoletine $categoriaBoletine): bool
    {
        return $user->can('delete_category_boletine');
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
