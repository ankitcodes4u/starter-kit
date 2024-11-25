<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Valuation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ValuationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_valuation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Valuation $valuation): bool
    {
        return $user->can('view_valuation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_valuation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Valuation $valuation): bool
    {
        return $user->can('update_valuation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Valuation $valuation): bool
    {
        return $user->can('delete_valuation');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_valuation');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Valuation $valuation): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Valuation $valuation): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Valuation $valuation): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }
}
