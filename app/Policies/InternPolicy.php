<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\Response;

class InternPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function intern(User $user){
        
        return $user->admin_position == 'Admin'
                ? Response::allow()
                : Response::denyWithStatus(401);
    }
}
