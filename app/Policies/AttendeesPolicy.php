<?php

namespace App\Policies;

use App\Models\Attendees;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendeesPolicy
{

    public function getAttendee(User $user):Response{
        
        return  $user->admin_position === 'Admin'
        ? Response::allow()
        : Response::denyWithStatus(401);
    }
    public function getUser(User $user):Response{

        return  $user->admin_position === 'Admin'
        ? Response::allow()
        : Response::denyWithStatus(401);
    }

    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attendees $attendees): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return  $user->admin_position === 'Admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
        return  $user->admin_position === 'Admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attendees $attendees): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attendees $attendees): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attendees $attendees): bool
    {
        //
    }
}
