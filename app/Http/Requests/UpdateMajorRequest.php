<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'education_group_id' => ['sometimes', 'integer', 'exists:education_groups,id'],
            'name' => ['sometimes', 'string', 'max:200'],
        ];
    }
}