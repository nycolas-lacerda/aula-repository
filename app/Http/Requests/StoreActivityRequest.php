<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:10240', 'mimes:jpg,jpeg,png,webp'],
        ];
    }
}
