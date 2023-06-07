<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureIdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:lectures,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID лекции!',
            'id.exists' => 'Указан неверный ID лекции!',
        ];
    }
}

