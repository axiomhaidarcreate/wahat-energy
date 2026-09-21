<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    protected array $allowedRoles = ['Admin', 'Sales', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Customer $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Customer $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Customer $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Customer $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Customer $model): bool
    {
        return $user->hasRole('Admin');
    }
}