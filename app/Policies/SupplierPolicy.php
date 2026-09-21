<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;

class SupplierPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Supplier $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Supplier $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Supplier $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Supplier $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Supplier $model): bool
    {
        return $user->hasRole('Admin');
    }
}