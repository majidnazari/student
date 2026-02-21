<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Student;
use App\Models\Term;

class TermController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreTermRequest $request, Student $student)
    {
        $term = Term::create([
            'student_id' => $student->id,
            ...$request->validated(),
        ]);

        return response()->json($term, 201);
    }

    public function show(Term $term)
    {
        $term->load(['results.lesson']);
        return response()->json($term);
    }

    public function edit(Term $term)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateTermRequest $request, Term $term)
    {
        $term->update($request->validated());
        return response()->json($term);
    }

    public function destroy(Term $term)
    {
        $term->delete();
        return response()->json(['message' => 'ترم حذف شد.']);
    }
}