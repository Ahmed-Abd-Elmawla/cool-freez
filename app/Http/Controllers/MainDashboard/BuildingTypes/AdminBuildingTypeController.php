<?php

namespace App\Http\Controllers\MainDashboard\BuildingTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainDashboard\BuildingTypes\BuildingTypeRequest;
use App\Models\BuildingType;
use Illuminate\Http\Request;

class AdminBuildingTypeController extends Controller
{
    public function index()
    {
        $BuildingTypes = BuildingType::all();
        return view('BuildingTypes.BuildingTypes_list' ,compact('BuildingTypes'));
    }

    public function store(BuildingTypeRequest $request)
    {
        $data = $request->validated();
        BuildingType::create($data);
        return redirect()->back()->with(['message' => 'Successfully added']);
    }

    public function update(BuildingTypeRequest $request, BuildingType $BuildingType)
    {
        $data = $request->validated();
        $BuildingType->update($data);
        return redirect()->back()->with(['message' => 'Successfully updated']);
    }

    public function destroy(BuildingType $BuildingType)
    {
        $BuildingType->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted']);
    }
}
