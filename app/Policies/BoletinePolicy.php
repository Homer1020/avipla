<?php

namespace App\Policies;

use App\Models\Afiliado;
use App\Models\Boletine;
use App\Models\AvisoCobro;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class BoletinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->afiliado) return true;
        return $user->can('view_boletine');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Boletine $boletine)
    {
        if($user->afiliado) {
            // si el afiliado tiene un aviso de no conciliado de mes previo
            $avisoCobro = AvisoCobro::where('afiliado_id', $user->afiliado->id)
                ->where('estado', '<>', 'conciliado')
                ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                ->whereRaw('MONTH(created_at) < MONTH(CURDATE())')
                ->exists();
            if(!$avisoCobro) return true;
        }
        return $user->can('view_boletine');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_boletine');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Boletine $boletine): bool
    {
        return $user->can('update_boletine');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Boletine $boletine): bool
    {
        return $user->can('delete_boletine');
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
