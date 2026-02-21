<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMajorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'education_group_id' => ['required', 'integer', 'exists:education_groups,id'],
            'name' => ['required', 'string', 'max:200'],
        ];
    }
}