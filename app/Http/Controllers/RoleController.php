<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->cannot('viewAny', Role::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $roles = Role::where('id', '!=', '1')
                            ->where('id', '!=', '2')
                            ->orderBy('title')
                            ->simplePaginate(1000);
            return view('roles.index', ['dataItems' => $roles]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List Roles - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->cannot('create', Role::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try{
            $modules = Module::where('slug', '!=', 'modules')
                                ->where('slug', '!=', 'user_types')
                                ->where('status', 1)
                                ->orderBy('name')
                                ->get();
            return view('roles.create', ['modules' => $modules]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create Role - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering create role page. ErrorLog ID: $logid."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $user = Auth::user();

        if ($user->cannot('create', Role::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $role_data = $request->validated();
            $role_data['created_by'] = $request->user()->id;

            if(!empty($role_data['permissions'])) {
                $permissions = $role_data['permissions'];
                $user_id = $request->user()->id;
                foreach($permissions as $key => $permission) {
                    $permissions[$key]['created_by'] = $user_id;
                }
                // dd($permissions);
            }

            $new_role = Role::create($role_data);

            if ($user->can('create', Permission::class)) {
                // $all_modules = Module::all();
                // $new_role_permissions = [];
                // foreach($all_modules as $module) {
                //     $new_role_permissions[] = ['module_id' => $module->id, 'can_create' => 0, 'can_delete' => 0, 'can_edit' => 0, 'can_view' => 0, 'created_by' => $user_id];
                // }
                if (!empty($permissions))
                    $new_role->permissions()->createMany($permissions);
            }

            return redirect()->route('admin.roles.index')->withSuccess('Role Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create Role - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $user = Auth::user();

        if ($user->cannot('view', $role)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $user = Auth::user();

        if ($user->cannot('update', $role)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try{
            $any_permission_model = Permission::first();
            $role_permissions = $role->permissions->keyBy('module_id')->toArray();
            $modules = Module::where('slug', '!=', 'modules')
                                ->where('slug', '!=', 'user_types')
                                ->where('status', 1)
                                ->orderBy('name')
                                ->get();
            return view('roles.edit', [
                                        'item' => $role,
                                        'role_permissions' => $role_permissions,
                                        'any_permission_model' => $any_permission_model,
                                        'modules' => $modules
                                    ]
                        );
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Edit Role - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering edit role page. Error Log ID: $logid."]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $user = Auth::user();

        if ($user->cannot('update', $role)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $role_data = $request->validated();

            $role->fill($role_data);
            $role->save();

            $any_permission_model = Permission::first();

            if ($user->can('update', $any_permission_model)) {

                if (!empty($role_data['permissions'])) {
                    $permissions = $role_data['permissions'];
                    // $submitted_permissions = $role_data['permissions'];
                    $user_id = $request->user()->id;
                    // $role_id = $role->id;
                    foreach ($permissions as $key => $permission) {
                        // $permissions[$key]['role_id'] = $role_id;
                        if(empty($permission['created_by']))
                            $permissions[$key]['created_by'] = $user_id;
                    }
                    // dd($submitted_permissions, $permissions);
                }

                if (!empty($permissions))
                    $role->permissions()->upsert(
                                                    $permissions,
                                                    ['role_id', 'module_id'], //Mysql ignores this argument and uses primary key (mostly 'id') element of array to detect existence of record
                                                    ['can_create', 'can_delete', 'can_edit', 'can_view']
                                                );
            }
            return redirect()->route('admin.roles.index')->withSuccess('Role Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update Role - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $user = Auth::user();

        if ($user->cannot('delete', $role)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $roleName = $role->title;
            $role->delete();
            return back()->withSuccess("Role \"$roleName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete Role - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the role. Error Log ID: $logid."]);
        }
    }
}
