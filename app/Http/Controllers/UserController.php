<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Designation;
use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::orderByDesc('id')->paginate(25);
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
        try {
            $designations = Designation::orderBy('title')->get();
            $usertypes = UserType::orderBy('type')->get();
            return view('users.create', ['designations' => $designations, 'usertypes' => $usertypes]);
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
        try {
            $user_data = $request->validated();
            $user_data['created_by'] = $request->user()->id;

            $new_user = User::create($user_data);

            if(!empty($user_data['user_image'])){
                $extension = $request->user_image->extension();
                $file_name = 'user_image_' . $new_user->id . '.' . $extension;
                $storage_path = 'user_images/profile';

                $request->user_image->storePubliclyAs($storage_path, $file_name, 'public');

                $image_path = 'storage/user_images/profile/' . $file_name;
                $new_user->image_path = $image_path;
                $new_user->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
