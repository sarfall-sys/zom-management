<?php

namespace App\Policies;

use App\Models\User;

class CountryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
        
        

    }
        public function viewAny(User $user): bool
    {
        //
        return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
    }
}
