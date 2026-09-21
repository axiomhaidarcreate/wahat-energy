<?php

namespace App\Policies;

use App\Models\Warehouse;
use App\Models\User;

class WarehousePolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Warehouse $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Warehouse $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Warehouse $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Warehouse $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Warehouse $model): bool
    {
        return $user->hasRole('Admin');
    }
}