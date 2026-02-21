<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermLessonResultRequest;
use App\Http\Requests\UpdateTermLessonResultRequest;
use App\Models\Term;
use App\Models\TermLessonResult;

class TermLessonResultController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Not used in this API)
     */
    public function index()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/terms/{term}/results
     */
    public function store(StoreTermLessonResultRequest $request, Term $term)
    {
        $result = TermLessonResult::create([
            'term_id' => $term->id,
            ...$request->validated(),
        ]);

        $result->load('lesson');

        return response()->json($result, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TermLessonResult $termLessonResult)
    {
        $termLessonResult->load(['term.student', 'lesson']);

        return response()->json($termLessonResult);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TermLessonResult $termLessonResult)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/results/{result}
     */
    public function update(
        UpdateTermLessonResultRequest $request,
        TermLessonResult $termLessonResult
    ) {
        $termLessonResult->update($request->validated());
        $termLessonResult->load('lesson');

        return response()->json($termLessonResult);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/results/{result}
     */
    public function destroy(TermLessonResult $termLessonResult)
    {
        $termLessonResult->delete();

        return response()->json(['message' => 'ردیف درس حذف شد.']);
    }
}