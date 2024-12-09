<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class MinistryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function ministry(User $user):Response{
        
        return $user->admin_position === 'Admin'
        ? Response::allow()
        : Response::denyWithStatus(401);
    }
}
