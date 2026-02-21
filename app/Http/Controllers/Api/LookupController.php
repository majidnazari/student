<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\EducationGroup;
use App\Models\Major;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    /**
     * GET /api/v1/colleges
     */
    public function colleges()
    {
        return response()->json(
            College::query()
                ->orderBy('name')
                ->get(['id', 'name'])
        );
    }

    /**
     * GET /api/v1/education-groups
     */
    public function educationGroups()
    {
        return response()->json(
            EducationGroup::query()
                ->orderBy('name')
                ->get(['id', 'name'])
        );
    }

    /**
     * GET /api/v1/majors?education_group_id=1
     */
    public function majors(Request $request)
    {
        $majors = Major::query()
            ->when(
                $request->filled('education_group_id'),
                fn($q) => $q->where(
                    'education_group_id',
                    (int) $request->input('education_group_id')
                )
            )
            ->orderBy('name')
            ->get(['id', 'education_group_id', 'name']);

        return response()->json($majors);
    }

    /**
     * GET /api/v1/lessons
     */
    public function lessons()
    {
        return response()->json(
            Lesson::query()
                ->orderBy('code')
                ->get(['id', 'code', 'name', 'unit'])
        );
    }
}