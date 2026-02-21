<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Models\Student;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Not used. Terms are loaded via Student report)
     */
    public function index()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Show the form for creating a new resource.
     * (Not used in API)
     */
    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/students/{student}/terms
     */
    public function store(StoreTermRequest $request, Student $student)
    {
        $term = Term::create([
            'student_id' => $student->id,
            ...$request->validated(),
        ]);

        return response()->json($term, 201);
    }

    /**
     * Display the specified resource.
     * (Optional - not needed for your UI)
     */
    public function show(Term $term)
    {
        $term->load(['student', 'results.lesson']);

        return response()->json($term);
    }

    /**
     * Show the form for editing the specified resource.
     * (Not used in API)
     */
    public function edit(Term $term)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/terms/{term}
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        $term->update($request->validated());

        return response()->json($term);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/terms/{term}
     */
    public function destroy(Term $term)
    {
        $term->delete();

        return response()->json(['message' => 'ترم حذف شد.']);
    }
}