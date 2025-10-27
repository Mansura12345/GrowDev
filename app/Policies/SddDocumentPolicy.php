<?php

namespace App\Policies;

use App\Models\SddDocument;
use App\Models\User;

class SddDocumentPolicy
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
    public function view(User $user, SddDocument $sddDocument): bool
    {
        return $user->id === $sddDocument->user_id;
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
    public function update(User $user, SddDocument $sddDocument): bool
    {
        return $user->id === $sddDocument->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SddDocument $sddDocument): bool
    {
        return $user->id === $sddDocument->user_id;
    }
}
