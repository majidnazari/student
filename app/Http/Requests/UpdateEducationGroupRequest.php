<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEducationGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('education_group')?->id ?? $this->route('education_group');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:200',
                Rule::unique('education_groups', 'name')->ignore($id),
            ],
        ];
    }
}