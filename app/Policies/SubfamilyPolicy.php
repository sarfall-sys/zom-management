<?php

namespace App\Policies;

use App\Models\Subfamily;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubfamilyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subfamily $subfamily): bool
    {
        //
        return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->role_id === User::ROLE_ADMIN || $user->role_id === User::ROLE_MANAGER;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Subfamily $subfamily): bool
    {
        //
        return $user->role_id === User::ROLE_ADMIN || $user->role_id === User::ROLE_MANAGER;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Subfamily $subfamily): bool
    {
        //
        return $user->role_id === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subfamily $subfamily): bool
    {
        //
        return $user->role_id === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subfamily $subfamily): bool
    {
        //
        return $user->role_id === User::ROLE_ADMIN;
    }
}
