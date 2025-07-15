<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTypeRequest;
use App\Http\Requests\UpdateUserTypeRequest;
use App\Models\UserType;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->cannot('viewAny', UserType::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $usertypes = UserType::orderByDesc('id')->simplePaginate(1000);
            return view('usertypes.index', ['dataItems' => $usertypes]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List User Types - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->cannot('create', UserType::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('usertypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserTypeRequest $request)
    {
        $user = Auth::user();

        if ($user->cannot('create', UserType::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $usertype_data = $request->validated();
            $usertype_data['created_by'] = $request->user()->id;
            UserType::create($usertype_data);
            return redirect()->route('admin.userTypes.index')->withSuccess('User Type Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create User Type - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserType $userType)
    {
        $user = Auth::user();

        if ($user->cannot('view', $userType)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return redirect()->route('admin.userTypes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserType $userType)
    {
        $user = Auth::user();

        if ($user->cannot('update', $userType)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('usertypes.edit', ['item' => $userType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserTypeRequest $request, UserType $userType)
    {
        $user = Auth::user();

        if ($user->cannot('update', $userType)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $usertype_data = $request->validated();
            $userType->fill($usertype_data);
            $userType->save();
            return redirect()->route('admin.userTypes.index')->withSuccess('User Type Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update User Type - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $userType)
    {
        $user = Auth::user();

        if ($user->cannot('delete', $userType)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $userTypeName = $userType->type;
            $userType->delete();
            return back()->withSuccess("User Type \"$userTypeName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete User Type - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the user type. Error Log ID: $logid."]);
        }
    }
}
