<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student')?->id ?? $this->route('student');

        return [
            'college_id' => ['sometimes', 'integer', 'exists:colleges,id'],
            'education_group_id' => ['sometimes', 'integer', 'exists:education_groups,id'],
            'major_id' => ['sometimes', 'integer', 'exists:majors,id'],

            'student_number' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('students', 'student_number')->ignore($studentId),
            ],

            'first_name' => ['sometimes', 'string', 'max:100'],
            'last_name' => ['sometimes', 'string', 'max:100'],

            'photo_path' => ['nullable', 'string', 'max:500'],
        ];
    }
}
