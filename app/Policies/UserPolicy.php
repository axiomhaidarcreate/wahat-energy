<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    protected array $allowedRoles = ['Admin'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('Admin');
    }
}