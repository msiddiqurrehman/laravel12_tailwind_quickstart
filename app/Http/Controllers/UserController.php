<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Country;
use App\Models\Designation;
use App\Models\EmpDetail;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\State;
use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('viewAny', User::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $users = User::where('id', '!=', '1')
                            ->where('id', '!=', '2')
                            ->orderBy('first_name')
                            ->simplePaginate(1000);
            return view('users.index', ['dataItems' => $users]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List Users - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('create', User::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designations = Designation::orderBy('title')->get();
            $usertypes = UserType::orderBy('type')->get();
            $roles = Role::where('id', '!=', '1')
                            ->where('id', '!=', '2')
                            ->orderBy('title')
                            ->get();
            $states = State::orderBy('name')->get();
            $countries = Country::orderBy('name')->get();
            return view('users.create', [
                                            'designations' => $designations, 
                                            'usertypes' => $usertypes, 
                                            'roles' => $roles, 
                                            'states' => $states, 
                                            'countries' => $countries
                                        ]
                        );
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create User - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering create user page. Error Log ID: $logid."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('create', User::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $user_data = $request->validated();
            // dd($user_data);
            $user_data['created_by'] = $request->user()->id;

            $new_user = User::create($user_data);

            // Upload image if exists.
            if(!empty($user_data['user_image'])){
                $extension = $request->user_image->extension();
                $file_name = 'user_image_' . $new_user->id . '_' . time() . '.' . $extension;
                $storage_path = 'user/images/profile';

                $request->user_image->storePubliclyAs($storage_path, $file_name, 'public');

                $image_path = 'storage/' . $storage_path . '/' . $file_name;
                $new_user->image_path = $image_path;
                $new_user->save();
            }

            // Attach role(s) if assigned.
            if(!empty($user_data['user_role_ids'])) {
                $role_ids = [];
                foreach($user_data['user_role_ids'] as $role_id) {
                    $role_ids[$role_id] = ['created_by' => $user_data['created_by']];
                }
                $new_user->roles()->attach($role_ids);
            }

            // Store Employee Details if exists.
            if ($auth_user->can('create', EmpDetail::class)) {
                if ($user_data['user_type_id'] == 1 && !empty($user_data['emp_detail'])) {
                    $emp_detail = $user_data['emp_detail'];

                    // Upload identity document if exists.
                    if (!empty($user_data['emp_detail']['identity_document'])) {
                        $identity_doc_image = $user_data['emp_detail']['identity_document'];
                        $extension = $identity_doc_image->extension();
                        $file_name = 'id_' . $new_user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/identity_document';

                        $identity_doc_image->storePubliclyAs($storage_path, $file_name, 'public');

                        $identity_document_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['identity_document_path'] = $identity_document_path;
                    }

                    // Upload educational document if exists.
                    if (!empty($user_data['emp_detail']['education_document'])) {
                        $education_doc_image = $user_data['emp_detail']['education_document'];
                        $extension = $education_doc_image->extension();
                        $file_name = 'edu_doc_' . $new_user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/education_document';

                        $education_doc_image->storePubliclyAs($storage_path, $file_name, 'public');

                        $education_document_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['education_document_path'] = $education_document_path;
                    }

                    // Upload resume if exists.
                    if (!empty($user_data['emp_detail']['resume'])) {
                        $resume = $user_data['emp_detail']['resume'];
                        $extension = $resume->extension();
                        $file_name = 'resume_' . $new_user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/resumes';

                        $resume->storePubliclyAs($storage_path, $file_name, 'public');

                        $resume_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['resume_path'] = $resume_path;
                    }

                    // Save Staff (Employee) Details to database
                    $new_user->empDetail()->create($emp_detail);
                }
            }

            return redirect()->route('admin.users.index')->withSuccess('User Added Successfully!');

        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create User - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('view', $user)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('update', $user)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designations = Designation::orderBy('title')->get();
            $usertypes = UserType::orderBy('type')->get();
            $roles = Role::where('id', '!=', '1')
                            ->where('id', '!=', '2')
                            ->orderBy('title')
                            ->get();
            $assigned_role_ids = RoleUser::where('user_id', $user->id)
                                        ->pluck('role_id')
                                        ->toArray();
            $states = State::orderBy('name')->get();
            $countries = Country::orderBy('name')->get();
            return view('users.edit', [
                                        'item' => $user, 
                                        'designations' => $designations, 
                                        'usertypes' => $usertypes, 
                                        'roles' => $roles,
                                        'assigned_role_ids' => $assigned_role_ids,
                                        'states' => $states,
                                        'countries' => $countries
                                    ]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Edit User - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering edit user page. Error Log ID: $logid."]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('update', $user)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try{
            $user_data = $request->validated();
            // dd($request->all(), $user_data);
            // Remove password from user's data to avoid unnecessary password update.
            if (empty($user_data['password'])) {
                unset($user_data['password']);
            }

            if (!empty($user_data['user_image'])) {
                // Delete Old Image
                if (!empty($user->image_path)) {
                    $file_path = ltrim($user->image_path, 'storage/');
                    Storage::disk('public')->delete($file_path);
                }

                // Save New Image
                $extension = $request->user_image->extension();
                $file_name = 'user_image_' . $user->id . '_' . time() . '.' . $extension;
                $storage_path = 'user_images/profile';

                $request->user_image->storePubliclyAs($storage_path, $file_name, 'public');

                $image_path = 'storage/user_images/profile/' . $file_name;
                $user_data['image_path'] = $image_path;
            } else {
                if (!empty($user_data['delete-user-image'])) {
                    $file_path = ltrim($user->image_path, 'storage/');
                    Storage::disk('public')->delete($file_path);
                    $user_data['image_path'] = null;
                }
            }

            $user->fill($user_data);
            // dd($user_data, $user);
            $user->save();

            // Update user role(s).
            $role_ids = [];
            if (!empty($user_data['user_role_ids'])) {
                $created_by = $request->user()->id;
                foreach ($user_data['user_role_ids'] as $role_id) {
                    $role_ids[$role_id] = ['created_by' => $created_by];
                }
            }

            $user->roles()->sync($role_ids);

            // Update Employee Details.
            if ($auth_user->can('update', $user->empDetail)) {
                if ($user_data['user_type_id'] == 1 && !empty($user_data['emp_detail'])) {
                    $emp_detail = $user_data['emp_detail'];

                    // Update identity document.
                    if (!empty($emp_detail['identity_document'])) {

                        // Delete Old Image
                        $existing_id_doc_image = $user->empDetail != null ? $user->empDetail->identity_document_path : '';
                        if (!empty($existing_id_doc_image)) {
                            $file_path = ltrim($existing_id_doc_image, 'storage/');
                            Storage::disk('public')->delete($file_path);
                        }

                        $identity_doc_image = $emp_detail['identity_document'];
                        $extension = $identity_doc_image->extension();
                        $file_name = 'id_' . $user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/identity_document';

                        $identity_doc_image->storePubliclyAs($storage_path, $file_name, 'public');

                        $identity_document_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['identity_document_path'] = $identity_document_path;
                    } else {
                        if (!empty($emp_detail['delete-id-doc'])) {
                            $existing_id_doc_image = $user->empDetail != null ? $user->empDetail->identity_document_path : '';
                            if (!empty($existing_id_doc_image)) {
                                $file_path = ltrim($existing_id_doc_image, 'storage/');
                                Storage::disk('public')->delete($file_path);
                            }
                            $emp_detail['identity_document_path'] = null;
                        }
                    }

                    // Update educational document if exists.
                    if (!empty($emp_detail['education_document'])) {

                        // Delete Old Image
                        $existing_edu_doc_image = $user->empDetail != null ? $user->empDetail->education_document_path : '';
                        if (!empty($existing_edu_doc_image)) {
                            $file_path = ltrim($existing_edu_doc_image, 'storage/');
                            Storage::disk('public')->delete($file_path);
                        }

                        $education_doc_image = $emp_detail['education_document'];
                        $extension = $education_doc_image->extension();
                        $file_name = 'edu_doc_' . $user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/education_document';

                        $education_doc_image->storePubliclyAs($storage_path, $file_name, 'public');

                        $education_document_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['education_document_path'] = $education_document_path;
                    } else {
                        if (!empty($emp_detail['delete-edu-doc'])) {
                            $existing_edu_doc_image = $user->empDetail != null ? $user->empDetail->education_document_path : '';
                            if (!empty($existing_edu_doc_image)) {
                                $file_path = ltrim($existing_edu_doc_image, 'storage/');
                                Storage::disk('public')->delete($file_path);
                            }
                            $emp_detail['education_document_path'] = null;
                        }
                    }

                    // Update resume if exists.
                    if (!empty($emp_detail['resume'])) {

                        // Delete Old Image
                        $existing_resume = $user->empDetail != null ? $user->empDetail->resume_path : '';
                        if (!empty($existing_resume)) {
                            $file_path = ltrim($existing_resume, 'storage/');
                            Storage::disk('public')->delete($file_path);
                        }

                        $resume = $emp_detail['resume'];
                        $extension = $resume->extension();
                        $file_name = 'resume_' . $user->id . '_' . time() . '.' . $extension;
                        $storage_path = 'user/docs/resumes';

                        $resume->storePubliclyAs($storage_path, $file_name, 'public');

                        $resume_path = 'storage/' . $storage_path . '/' . $file_name;
                        $emp_detail['resume_path'] = $resume_path;
                    } else {
                        if (!empty($emp_detail['delete-resume'])) {
                            $existing_resume = $user->empDetail != null ? $user->empDetail->resume_path : '';
                            if (!empty($existing_resume)) {
                                $file_path = ltrim($existing_resume, 'storage/');
                                Storage::disk('public')->delete($file_path);
                            }
                            $emp_detail['resume_path'] = null;
                        }
                    }

                    // Save Staff (Employee) Details to database
                    // $user->empDetail()->create($emp_detail);
                    $user->empDetail()->updateOrCreate(
                        ['user_id' => $user->id],
                        $emp_detail
                    );
                }
            }

            return redirect()->route('admin.users.index')->withSuccess('User Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update User - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $auth_user = Auth::user();

        if ($auth_user->cannot('delete', $user)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $userName = $user->first_name . ' ' . $user->last_name;
            
            // Delete User Image
            if(!empty($user->image_path)){
                $file_path = ltrim($user->image_path, 'storage/');
                Storage::disk('public')->delete($file_path);
            }

            // Delete Identity Doc Image
            if (!empty($user->empDetail) && !empty($user->empDetail->identity_document_path)) {
                $file_path = ltrim($user->empDetail->identity_document_path, 'storage/');
                Storage::disk('public')->delete($file_path);
            }

            // Delete Education Doc Image
            if (!empty($user->empDetail) && !empty($user->empDetail->education_document_path)) {
                $file_path = ltrim($user->empDetail->education_document_path, 'storage/');
                Storage::disk('public')->delete($file_path);
            }

            // Delete Resume
            if (!empty($user->empDetail) && !empty($user->empDetail->resume_path)) {
                $file_path = ltrim($user->empDetail->resume_path, 'storage/');
                Storage::disk('public')->delete($file_path);
            }

            $user->delete();
            return back()->withSuccess("User \"$userName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete User - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the user. Error Log ID: $logid."]);
        }
    }
}
