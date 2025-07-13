<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Log;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $states = State::orderBy('name')->simplePaginate(1000);
            return view('states.index', ['dataItems' => $states]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List States - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $countries = Country::orderBy('name')->get();
            return view(
                'states.create', [ 'countries' => $countries ]
            );
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create State - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering create state page. Error Log ID: $logid."]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request)
    {
        try {
            $state_data = $request->validated();
            $state_data['created_by'] = $request->user()->id;
            State::create($state_data);
            return redirect()->route('admin.states.index')->withSuccess('State Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create State - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        return redirect()->route('admin.states.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        try {
            $countries = Country::orderBy('name')->get();
            return view(
                'states.edit',
                ['item' => $state, 'countries' => $countries]
            );
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Edit State - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering create state page. Error Log ID: $logid."]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        try {
            $state_data = $request->validated();
            $state->fill($state_data);
            $state->save();
            return redirect()->route('admin.states.index')->withSuccess('State Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update State - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        try {
            $stateName = $state->name;
            $state->delete();
            return back()->withSuccess("State \"$stateName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete State - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the state. Error Log ID: $logid."]);
        }
    }
}
