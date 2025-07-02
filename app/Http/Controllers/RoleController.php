<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::orderByDesc('id')->paginate(25);
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
        try{
            $modules = Module::where('slug', '!=', 'modules')
                                ->where('slug', '!=', 'user_types')
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

            // $all_modules = Module::all();
            // $new_role_permissions = [];
            // foreach($all_modules as $module) {
            //     $new_role_permissions[] = ['module_id' => $module->id, 'can_create' => 0, 'can_delete' => 0, 'can_edit' => 0, 'can_view' => 0, 'created_by' => $user_id];
            // }
            if (!empty($permissions))
                $new_role->permissions()->createMany($permissions);

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
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        try{
            $any_permission_model = Permission::first();
            $role_permissions = $role->permissions->keyBy('module_id')->toArray();
            $modules = Module::where('slug', '!=', 'modules')
                                ->where('slug', '!=', 'user_types')
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
        try {
            $role_data = $request->validated();

            if (!empty($role_data['permissions'])) {
                $permissions = $role_data['permissions'];
                $user_id = $request->user()->id;
                foreach ($permissions as $key => $permission) {
                    if(empty($permission['id']))
                        $permissions[$key]['created_by'] = $user_id;
                }
                // dd($permissions);
            }

            $role->fill($role_data);
            $role->save();

            if (!empty($permissions))
                $role->permissions()->upsert(
                                                $permissions,
                                                ['id'], //Mysql ignores this argument and uses primary key (mostly 'id') element of array to detect existence of record
                                                ['can_create', 'can_delete', 'can_edit', 'can_view']
                                            );

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
