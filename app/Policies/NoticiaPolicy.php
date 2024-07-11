<?php

namespace App\Policies;

use App\Models\Noticia;
use App\Models\User;

class NoticiaPolicy
{
    public function before(User $user) {
        $user->load(['roles']);
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
        return $user->roles()->where('name', 'editor')->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Noticia $noticia): bool
    {
        return $user->roles()->where('name', 'editor')->exists();
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
    public function update(User $user, Noticia $noticia): bool
    {
        return $noticia->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Noticia $noticia): bool
    {
        return $noticia->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Noticia $noticia): bool
    {
        return $noticia->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Noticia $noticia): bool
    {
        return $noticia->user_id === $user->id;
    }
}
