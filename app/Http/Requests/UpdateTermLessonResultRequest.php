<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTermLessonResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // خیلی مهم: false باعث 403 می‌شود
    }

    public function rules(): array
    {
        return [
            'lesson_id' => ['sometimes', 'integer', 'exists:lessons,id'],
            'grade' => ['nullable', 'numeric', 'min:0', 'max:20'],
            'grade_status' => ['sometimes', 'integer', 'in:1,2,3,4'],
            'coach_name' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }
}