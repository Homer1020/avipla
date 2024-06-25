<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\Pago;
use App\Models\User;

class PagoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->afiliado()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pago $pago): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->afiliado()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pago $pago): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pago $pago): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pago $pago): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pago $pago): bool
    {
        return true;
    }
}
