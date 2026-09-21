<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;

class BrandPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Brand $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Brand $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Brand $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Brand $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Brand $model): bool
    {
        return $user->hasRole('Admin');
    }
}