<?php

namespace App\Policies;

use App\Models\SiteSurvey;
use App\Models\User;

class SiteSurveyPolicy
{
    protected array $allowedRoles = ['Admin', 'Technician', 'Sales'];

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function view(User $user, SiteSurvey $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function update(User $user, SiteSurvey $model): bool
    {
        return $user->hasAnyRole(['Admin', ...$this->allowedRoles]);
    }

    public function delete(User $user, SiteSurvey $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function restore(User $user, SiteSurvey $model): bool
    {
        return $user->hasRole('Admin');
    }

    public function forceDelete(User $user, SiteSurvey $model): bool
    {
        return $user->hasRole('Admin');
    }
}