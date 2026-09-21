<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

class ExpensePolicy
{
    protected array $allowedRoles = ['Admin', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Expense $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Expense $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Expense $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Expense $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Expense $model): bool
    {
        return $user->hasRole('Admin');
    }
}