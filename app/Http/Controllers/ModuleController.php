<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('modules create new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        dd('modules save new');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        dd('modules show details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        dd('modules edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        dd('modules update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        dd('modules delete');
    }
}
