<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Product $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Product $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Product $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Product $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Product $model): bool
    {
        return $user->hasRole('Admin');
    }
}