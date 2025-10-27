<?php

namespace App\Policies;

use App\Models\SrsDocument;
use App\Models\User;

class SrsDocumentPolicy
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
    public function view(User $user, SrsDocument $srsDocument): bool
    {
        return $user->id === $srsDocument->user_id;
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
    public function update(User $user, SrsDocument $srsDocument): bool
    {
        return $user->id === $srsDocument->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SrsDocument $srsDocument): bool
    {
        return $user->id === $srsDocument->user_id;
    }
}
