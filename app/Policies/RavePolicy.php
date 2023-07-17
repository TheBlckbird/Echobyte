<?php

namespace App\Policies;

use App\Models\Rave;
use App\Models\User;

class RavePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rave $rave): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rave $rave): bool
    {
        return $user->id === $rave->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rave $rave): bool
    {
        return $user->id === $rave->user_id;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Rave $rave): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Rave $rave): bool
    // {
    //     //
    // }
}
