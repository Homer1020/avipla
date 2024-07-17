<?php

namespace App\Policies;

use App\Models\Boletine;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class BoletinePolicy
{
    public function before(User $user) {
        $user->load('roles');
        if($user->roles()->whereIn('name', ['administrador', 'editor', 'usuario'])->exists()){
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
    public function view(User $user, Boletine $boletine)
    {
        $afiliadoSolvente = $user->afiliado()->whereDoesntHave('avisosCobros', function($query) {
            $query->where('estado', '<>', 'conciliado');
        })->exists();
        if($afiliadoSolvente) {
            return Response::allow();
        } else {
            return Response::deny('Usted tiene recibos pendientes por pagar.');
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->where('name', 'editor')->exists();
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
