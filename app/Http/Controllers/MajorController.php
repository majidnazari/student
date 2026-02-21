<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $majors = Major::query()
            ->when(
                $request->filled('education_group_id'),
                fn($q) => $q->where('education_group_id', (int) $request->input('education_group_id'))
            )
            ->orderBy('name')
            ->get();

        return response()->json($majors);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreMajorRequest $request)
    {
        $major = Major::create($request->validated());
        return response()->json($major, 201);
    }

    public function show(Major $major)
    {
        return response()->json($major);
    }

    public function edit(Major $major)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateMajorRequest $request, Major $major)
    {
        $major->update($request->validated());
        return response()->json($major);
    }

    public function destroy(Major $major)
    {
        $major->delete();
        return response()->json(['message' => 'رشته حذف شد.']);
    }
}