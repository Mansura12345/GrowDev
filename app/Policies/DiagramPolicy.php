<?php

namespace App\Policies;

use App\Models\Diagram;
use App\Models\User;

class DiagramPolicy
{
    /**
     * Determine if the user can view any diagram.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the diagram.
     */
    public function view(User $user, Diagram $diagram): bool
    {
        return true;
    }

    /**
     * Determine if the user can create diagram.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update the diagram.
     */
    public function update(User $user, Diagram $diagram): bool
    {
        return $diagram->created_by === $user->id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the diagram.
     */
    public function delete(User $user, Diagram $diagram): bool
    {
        return $diagram->created_by === $user->id || $user->isAdmin();
    }
}
