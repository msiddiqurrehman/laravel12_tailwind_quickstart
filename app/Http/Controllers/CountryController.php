<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->cannot('viewAny', Country::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $countries = Country::orderBy('name')->simplePaginate(1000);
            return view('countries.index', ['dataItems' => $countries]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List Countries - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->cannot('create', Country::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $user = Auth::user();

        if ($user->cannot('create', Country::class)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $country_data = $request->validated();
            $country_data['created_by'] = $request->user()->id;
            Country::create($country_data);
            return redirect()->route('admin.countries.index')->withSuccess('Country Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create Country - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $user = Auth::user();

        if ($user->cannot('view', $country)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return redirect()->route('admin.countries.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $user = Auth::user();

        if ($user->cannot('update', $country)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        return view('countries.edit', ['item' => $country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $user = Auth::user();

        if ($user->cannot('update', $country)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $country_data = $request->validated();
            $country->fill($country_data);
            $country->save();
            return redirect()->route('admin.countries.index')->withSuccess('Country Updated Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Update Country - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $user = Auth::user();

        if ($user->cannot('delete', $country)) {
            return redirect()->route('admin.dashboard')->withErrors(["errors" => "You are not allowed to perform this action."]);
        }

        try {
            $countryName = $country->name;
            $country->delete();
            return back()->withSuccess("Country \"$countryName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete Country - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the country. Error Log ID: $logid."]);
        }
    }
}
