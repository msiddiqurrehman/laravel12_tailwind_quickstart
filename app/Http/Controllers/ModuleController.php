<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;

use Exception;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $modules = Module::orderByDesc('id')->paginate(25);
            // dd($campaigns->toArray());
            return view('modules.index', ['dataItems' => $modules]);
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - List Modules - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while rendering the page. Error Log ID: $logid."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request)
    {
        try{
            $module_data = $request->validated();
            $module_data['created_by'] = $request->user()->id;
            Module::create($module_data);
            return redirect()->route('admin.modules.index')->withSuccess('Module Added Successfully!');
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Create Module - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while performing this action. Error Log ID: $logid."]);
        }
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
        try {
            $moduleName = $module->name;
            $module->delete();
            return back()->withSuccess("Module \"$moduleName\" deleted successfully.");
        } catch (Exception $e) {
            $logid = time();
            Log::error("LogId: $logid - Delete Module - " . $e->getMessage());
            return back()->withErrors(["errors" => "An error occurred while deleting the module. Error Log ID: $logid."]);
        }
        
    }
}
