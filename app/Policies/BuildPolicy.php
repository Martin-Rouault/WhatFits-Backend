<?php

namespace App\Policies;

use App\Models\Build;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuildPolicy
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
    public function view(User $user, Build $build): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Build $build): bool
    {
        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Build $build): bool
    {
        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Build $build): bool
    {
        return false;
    }
}
