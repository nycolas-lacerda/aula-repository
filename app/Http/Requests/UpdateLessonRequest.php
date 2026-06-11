<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'objective' => ['required', 'string'],
            'grade_id' => ['required', 'exists:grades,id'],
            'activities' => ['nullable', 'array'],
            'activities.*' => ['integer', 'exists:activities,id'],
        ];
    }
}
