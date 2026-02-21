<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollegeRequest;
use App\Http\Requests\UpdateCollegeRequest;
use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            College::query()->orderBy('name')->get()
        );
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreCollegeRequest $request)
    {
        $college = College::create($request->validated());
        return response()->json($college, 201);
    }

    public function show(College $college)
    {
        return response()->json($college);
    }

    public function edit(College $college)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateCollegeRequest $request, College $college)
    {
        $college->update($request->validated());
        return response()->json($college);
    }

    public function destroy(College $college)
    {
        $college->delete();
        return response()->json(['message' => 'دانشکده حذف شد.']);
    }
}