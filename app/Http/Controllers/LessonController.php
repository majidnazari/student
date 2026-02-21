<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            Lesson::query()->orderBy('code')->get()
        );
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        return response()->json($lesson, 201);
    }

    public function show(Lesson $lesson)
    {
        return response()->json($lesson);
    }

    public function edit(Lesson $lesson)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return response()->json($lesson);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return response()->json(['message' => 'درس حذف شد.']);
    }
}