<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('grades')->ignore($this->grade),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome da série',
        ];
    }
}
