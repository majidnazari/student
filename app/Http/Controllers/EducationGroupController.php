<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationGroupRequest;
use App\Http\Requests\UpdateEducationGroupRequest;
use App\Models\EducationGroup;
use Illuminate\Http\Request;

class EducationGroupController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            EducationGroup::query()->orderBy('name')->get()
        );
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreEducationGroupRequest $request)
    {
        $group = EducationGroup::create($request->validated());
        return response()->json($group, 201);
    }

    public function show(EducationGroup $educationGroup)
    {
        return response()->json($educationGroup);
    }

    public function edit(EducationGroup $educationGroup)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateEducationGroupRequest $request, EducationGroup $educationGroup)
    {
        $educationGroup->update($request->validated());
        return response()->json($educationGroup);
    }

    public function destroy(EducationGroup $educationGroup)
    {
        $educationGroup->delete();
        return response()->json(['message' => 'گروه آموزشی حذف شد.']);
    }
}