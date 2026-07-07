<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can update the target user.
     */
    public function update(User $auth, User $target): bool
    {
        if ($auth->hasRole('super_admin')) {
            return true;
        }

        // Admin cannot edit Super Admin
        if ($auth->hasRole('admin') && $target->hasRole('super_admin')) {
            return false;
        }

        return $auth->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the target user.
     */
    public function delete(User $auth, User $target): bool
    {
        if ($auth->hasRole('super_admin')) {
            return true;
        }

        // Admin cannot delete Super Admin
        if ($auth->hasRole('admin') && $target->hasRole('super_admin')) {
            return false;
        }

        return $auth->hasRole('admin');
    }
}
