<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;

class PurchaseOrderPolicy
{
    protected array $allowedRoles = ['Admin', 'Warehouse', 'Accountant'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, PurchaseOrder $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, PurchaseOrder $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, PurchaseOrder $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, PurchaseOrder $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, PurchaseOrder $model): bool
    {
        return $user->hasRole('Admin');
    }
}