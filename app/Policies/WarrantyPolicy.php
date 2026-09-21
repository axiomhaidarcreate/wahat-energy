<?php

namespace App\Policies;

use App\Models\Warranty;
use App\Models\User;

class WarrantyPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician', 'Accountant', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Warranty $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Warranty $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Warranty $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Warranty $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Warranty $model): bool
    {
        return $user->hasRole('Admin');
    }
}