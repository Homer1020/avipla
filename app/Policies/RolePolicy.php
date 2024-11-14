<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Contracts\Role;

class RolePolicy
{
    public function before(User $user) {
        if($user->roles()->where('name', 'admin')->exists()){
            return true;
        }
        return null;
    }
    
    public function viewAny(User $user): bool
    {
        return $user->can('view_role');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('view_role');
    }

    public function create(User $user): bool
    {
        return $user->can('create_user');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->can('update_user');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->can('delete_user');
    }

    public function restore(User $user, Role $role): bool
    {
        return false;
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return false;
    }
}
