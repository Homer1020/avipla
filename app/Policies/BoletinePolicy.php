<?php

namespace App\Policies;

use App\Models\Afiliado;
use App\Models\Boletine;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class BoletinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_boletine');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Boletine $boletine)
    {
        return $user->can('view_boletine');
        // $afiliado = $user->getAfiliado();
        // $afiliadoSolvente = Afiliado::where('id', $afiliado->id)->whereDoesntHave('avisosCobros', function($query) {
        //     $query
        //         ->where('estado', '<>', 'conciliado')
        //         ->where(function($query) {
        //             $query
        //                 ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
        //                 ->whereRaw('MONTH(created_at) < MONTH(CURDATE())');
        //             });
        // })->exists();
        // if($afiliadoSolvente) {
        //     return Response::allow();
        // } else {
        //     return Response::deny('Usted tiene recibos pendientes por pagar.');
        // }
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
