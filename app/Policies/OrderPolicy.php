<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    protected array $allowedRoles = ['Admin', 'Sales', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Order $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Order $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Order $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Order $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Order $model): bool
    {
        return $user->hasRole('Admin');
    }
}