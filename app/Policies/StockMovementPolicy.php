<?php

namespace App\Policies;

use App\Models\StockMovement;
use App\Models\User;

class StockMovementPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, StockMovement $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, StockMovement $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, StockMovement $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, StockMovement $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, StockMovement $model): bool
    {
        return $user->hasRole('Admin');
    }
}