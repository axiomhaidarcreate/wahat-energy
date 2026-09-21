<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    protected array $allowedRoles = ['Admin', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Invoice $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Invoice $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Invoice $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Invoice $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Invoice $model): bool
    {
        return $user->hasRole('Admin');
    }
}