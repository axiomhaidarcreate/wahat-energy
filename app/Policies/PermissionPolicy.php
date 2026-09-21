<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;

class PermissionPolicy
{
    protected array $allowedRoles = ['Admin'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Permission $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Permission $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Permission $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Permission $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Permission $model): bool
    {
        return $user->hasRole('Admin');
    }
}