<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:lessons,code'],
            'name' => ['required', 'string', 'max:200'],
            'unit' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }
}