<?php

namespace App\Policies;

use App\Models\TechnicianAssignment;
use App\Models\User;

class TechnicianAssignmentPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, TechnicianAssignment $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, TechnicianAssignment $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, TechnicianAssignment $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, TechnicianAssignment $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, TechnicianAssignment $model): bool
    {
        return $user->hasRole('Admin');
    }
}