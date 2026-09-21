<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    protected array $allowedRoles = ['Admin'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Role $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Role $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Role $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Role $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Role $model): bool
    {
        return $user->hasRole('Admin');
    }
}