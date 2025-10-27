<?php

namespace App\Policies;

use App\Models\Documentation;
use App\Models\User;

class DocumentationPolicy
{
    /**
     * Determine if the user can view any documentation.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the documentation.
     */
    public function view(User $user, Documentation $documentation): bool
    {
        return true;
    }

    /**
     * Determine if the user can create documentation.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update the documentation.
     */
    public function update(User $user, Documentation $documentation): bool
    {
        return $documentation->created_by === $user->id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the documentation.
     */
    public function delete(User $user, Documentation $documentation): bool
    {
        return $documentation->created_by === $user->id || $user->isAdmin();
    }
}
