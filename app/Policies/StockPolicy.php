<?php

namespace App\Policies;

use App\Models\Stock;
use App\Models\User;

class StockPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Stock $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Stock $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Stock $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Stock $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Stock $model): bool
    {
        return $user->hasRole('Admin');
    }
}