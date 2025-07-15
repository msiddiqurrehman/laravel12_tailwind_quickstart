<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Models\Designation;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->cannot('viewAny', Designation::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designations = Designation::orderByDesc('id')->simplePaginate(1000);
            return view('designations.index', ['dataItems' => $designations]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List Designations - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->cannot('create', Designation::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('designations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        $user = Auth::user();

        if ($user->cannot('create', Designation::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designation_data = $request->validated();
            $designation_data['created_by'] = $request->user()->id;
            Designation::create($designation_data);
            return redirect()->route('admin.designations.index')->withSuccess('Designation Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create Designation - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        $user = Auth::user();

        if ($user->cannot('view', $designation)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return redirect()->route('admin.designations.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        $user = Auth::user();

        if ($user->cannot('update', $designation)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('designations.edit', ['item' => $designation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $user = Auth::user();

        if ($user->cannot('update', $designation)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designation_data = $request->validated();
            $designation->fill($designation_data);
            $designation->save();
            return redirect()->route('admin.designations.index')->withSuccess('Designation Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update Designation - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $user = Auth::user();

        if ($user->cannot('delete', $designation)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $designationName = $designation->title;
            $designation->delete();
            return back()->withSuccess("Designation \"$designationName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete Designation - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the designation. Error Log ID: $logid."]);
        }
    }
}
