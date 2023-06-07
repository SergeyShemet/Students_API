<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentIdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:students,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID студента!',
            'id.exists' => 'Указан неверный ID студента!',
        ];
    }
}

