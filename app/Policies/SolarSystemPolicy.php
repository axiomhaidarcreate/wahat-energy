<?php

namespace App\Policies;

use App\Models\SolarSystem;
use App\Models\User;

class SolarSystemPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, SolarSystem $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, SolarSystem $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, SolarSystem $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, SolarSystem $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, SolarSystem $model): bool
    {
        return $user->hasRole('Admin');
    }
}