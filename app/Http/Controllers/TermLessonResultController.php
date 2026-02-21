<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTermLessonResultRequest;
use App\Http\Requests\UpdateTermLessonResultRequest;
use App\Models\Term;
use App\Models\TermLessonResult;

class TermLessonResultController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreTermLessonResultRequest $request, Term $term)
    {
        $result = TermLessonResult::create([
            'term_id' => $term->id,
            ...$request->validated(),
        ]);

        $result->load('lesson');

        return response()->json($result, 201);
    }

    public function show(TermLessonResult $termLessonResult)
    {
        $termLessonResult->load(['term.student', 'lesson']);
        return response()->json($termLessonResult);
    }

    public function edit(TermLessonResult $termLessonResult)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateTermLessonResultRequest $request, TermLessonResult $termLessonResult)
    {
        $termLessonResult->update($request->validated());
        $termLessonResult->load('lesson');

        return response()->json($termLessonResult);
    }

    public function destroy(TermLessonResult $termLessonResult)
    {
        $termLessonResult->delete();
        return response()->json(['message' => 'ردیف درس حذف شد.']);
    }
}