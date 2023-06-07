<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassIdRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:classes,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID класса!',
            'id.exists' => 'Указан неверный ID класса!',
        ];
    }
}
