<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
{
    protected array $allowedRoles = ['Admin'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Setting $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Setting $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Setting $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Setting $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Setting $model): bool
    {
        return $user->hasRole('Admin');
    }
}