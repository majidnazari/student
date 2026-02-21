<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCollegeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $collegeId = $this->route('college')?->id ?? $this->route('college');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:200',
                Rule::unique('colleges', 'name')->ignore($collegeId),
            ],
        ];
    }
}