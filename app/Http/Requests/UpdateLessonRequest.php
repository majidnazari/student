<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $lessonId = $this->route('lesson')?->id ?? $this->route('lesson');

        return [
            'code' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('lessons', 'code')->ignore($lessonId),
            ],
            'name' => ['sometimes', 'string', 'max:200'],
            'unit' => ['sometimes', 'integer', 'min:1', 'max:10'],
        ];
    }
}