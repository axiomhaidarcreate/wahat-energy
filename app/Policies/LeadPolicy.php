<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    protected array $allowedRoles = ['Admin', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, Lead $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, Lead $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, Lead $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, Lead $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, Lead $model): bool
    {
        return $user->hasRole('Admin');
    }
}