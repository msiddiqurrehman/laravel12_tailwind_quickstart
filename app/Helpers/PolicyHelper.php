<?php

// app/Helpers/PolicyHelper.php

use App\Models\Module;
use App\Models\Permission;

if (!function_exists('getModuleBySlug')) {
    /**
     * Get module by module slug.
     * 
     * @param string $input
     * @return Module $module
     */
    function getModuleBySlug($module_slug)
    {
        $module = Module::where('slug', $module_slug)->first();
        if ($module->status == 1) {
            return $module;
        } else {
            return false;
        }
    }
}

if (!function_exists('hasUserPermissionsByModule')) {
    /**
     * Check if user has permission to perform specified action on any module.
     * 
     * @param User $user
     * @param int $module_id
     * @param int $action
     * @return bool
     */
    function hasUserPermissionsByModule($user, $module_id, $action)
    {
        $permissions = Permission::where('module_id', $module_id) // Filter permissions by the specific module
            ->whereHas('role', function ($query) use ($user) { // Ensure the permission belongs to a role...
                $query->where('roles.status', 1)->whereHas('users', function ($q) use ($user) { // ...that is associated with the current user
                    $q->where('users.id', $user->id);
                });
            })
            ->get()
            ->pluck($action)
            ->toArray();
        // dd($permissions);
        // Alternate
        // $permissions = $user->roles()
        //     ->with(['permissions' => function ($query) use ($module_id) {
        //         $query->where('module_id', $module_id);
        //     }])
        //     ->get()->pluck('permissions')->toArray();

        if (!empty($permissions) && in_array("1", $permissions)) {
            return true;
        }

        return false;
    }
}
    

    