<?php

namespace App\Policies;

use App\Models\Quotation;
use App\Models\User;

class QuotationPolicy
{
    protected array $allowedRoles = ['Admin', 'Sales', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Quotation $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Quotation $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Quotation $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Quotation $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Quotation $model): bool
    {
        return $user->hasRole('Admin');
    }
}