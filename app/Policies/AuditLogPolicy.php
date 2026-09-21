<?php

namespace App\Policies;

use App\Models\AuditLog;
use App\Models\User;

class AuditLogPolicy
{
    protected array $allowedRoles = ['Admin'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, AuditLog $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, AuditLog $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, AuditLog $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, AuditLog $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, AuditLog $model): bool
    {
        return $user->hasRole('Admin');
    }
}