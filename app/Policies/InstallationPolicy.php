<?php

namespace App\Policies;

use App\Models\Installation;
use App\Models\User;

class InstallationPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Installation $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Installation $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Installation $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Installation $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Installation $model): bool
    {
        return $user->hasRole('Admin');
    }
}