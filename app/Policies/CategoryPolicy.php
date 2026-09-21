<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Category $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Category $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Category $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Category $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Category $model): bool
    {
        return $user->hasRole('Admin');
    }
}