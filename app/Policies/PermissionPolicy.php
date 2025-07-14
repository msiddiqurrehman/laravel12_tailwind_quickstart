<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Assign slug value for module which
     * should be identical to slug field value 
     * for this module in database modules table.
     */
    private $module_slug = "permissions";

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $module = getModuleBySlug($this->module_slug);

        if (empty($module)) {
            return false;
        }

        $is_allowed = hasUserPermissionsByModule($user, $module->id, 'can_view');

        if ($is_allowed)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        $module = getModuleBySlug($this->module_slug);

        if (empty($module)) {
            return false;
        }

        $is_allowed = hasUserPermissionsByModule($user, $module->id, 'can_view');

        if ($is_allowed)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $module = getModuleBySlug($this->module_slug);

        if (empty($module)) {
            return false;
        }

        $is_allowed = hasUserPermissionsByModule($user, $module->id, 'can_create');
        if ($is_allowed)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        $module = getModuleBySlug($this->module_slug);

        if (empty($module)) {
            return false;
        }

        $is_allowed = hasUserPermissionsByModule($user, $module->id, 'can_edit');
        if ($is_allowed)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        $module = getModuleBySlug($this->module_slug);

        if (empty($module)) {
            return false;
        }

        $is_allowed = hasUserPermissionsByModule($user, $module->id, 'can_delete');
        if ($is_allowed)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return false;
    }
}
