<?php

namespace App\Policies;

use App\Models\MaintenanceTicket;
use App\Models\User;

class MaintenanceTicketPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, MaintenanceTicket $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, MaintenanceTicket $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, MaintenanceTicket $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, MaintenanceTicket $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, MaintenanceTicket $model): bool
    {
        return $user->hasRole('Admin');
    }
}