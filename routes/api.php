<?php

use Illuminate\Support\Facades\Route;

// CRUD Controllers
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TermLessonResultController;

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\EducationGroupController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\LessonController;

// Lookup Controller (در Api folder)
use App\Http\Controllers\Api\LookupController;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Lookups (برای dropdownها) - بدون تداخل با CRUD
    |--------------------------------------------------------------------------
    */
    Route::prefix('lookups')->group(function () {
        Route::get('colleges', [LookupController::class, 'colleges']);
        Route::get('education-groups', [LookupController::class, 'educationGroups']);
        Route::get('majors', [LookupController::class, 'majors']); // ?education_group_id=
        Route::get('lessons', [LookupController::class, 'lessons']);
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD: Base data (colleges, education groups, majors, lessons)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('colleges', CollegeController::class)->except(['create', 'edit']);
    Route::apiResource('education-groups', EducationGroupController::class)->except(['create', 'edit']);
    Route::apiResource('majors', MajorController::class)->except(['create', 'edit']);
    Route::apiResource('lessons', LessonController::class)->except(['create', 'edit']);

    /*
    |--------------------------------------------------------------------------
    | CRUD: Students
    |--------------------------------------------------------------------------
    */
    Route::apiResource('students', StudentController::class)->except(['create', 'edit']);

    /*
    |--------------------------------------------------------------------------
    | CRUD: Terms
    |--------------------------------------------------------------------------
    | Create term for a student:
    | POST /students/{student}/terms
    |
    | Update/Delete term:
    | PUT /terms/{term}
    | DELETE /terms/{term}
    */
    Route::post('students/{student}/terms', [TermController::class, 'store']);
    Route::put('terms/{term}', [TermController::class, 'update']);
    Route::delete('terms/{term}', [TermController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | CRUD: Term Lesson Results
    |--------------------------------------------------------------------------
    | POST /terms/{term}/results
    | PUT /results/{termLessonResult}
    | DELETE /results/{termLessonResult}
    */
    Route::post('terms/{term}/results', [TermLessonResultController::class, 'store']);
    Route::put('results/{termLessonResult}', [TermLessonResultController::class, 'update']);
    Route::delete('results/{termLessonResult}', [TermLessonResultController::class, 'destroy']);
});