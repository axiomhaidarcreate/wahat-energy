<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Project $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Project $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Project $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Project $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Project $model): bool
    {
        return $user->hasRole('Admin');
    }
}