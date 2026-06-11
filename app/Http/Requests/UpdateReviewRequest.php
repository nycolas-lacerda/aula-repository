<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lesson_id' => ['required', 'exists:lessons,id'],
            'status' => ['required', Rule::in(['approved', 'rejected'])],
            'comments' => ['nullable', 'string', 'required_if:status,rejected'],
        ];
    }
}
