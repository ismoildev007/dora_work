<?php

namespace App\Policies;

use App\Models\Manager;
use App\Models\User;

class ManagerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Manager $manager): bool
    {
        return auth()->user()->role == 'admin';

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->role == 'admin';

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Manager $manager): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Manager $manager): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Manager $manager): bool
    {
        return auth()->user()->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Manager $manager): bool
    {
        return auth()->user()->role == 'admin';
    }
}
