<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    protected array $allowedRoles = ['Admin', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Payment $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Payment $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Payment $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Payment $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Payment $model): bool
    {
        return $user->hasRole('Admin');
    }
}