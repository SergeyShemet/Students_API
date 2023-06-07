<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:students,id',
            'name' => 'required',
            'class_id' => 'required|exists:classes,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID студента!',
            'id.exists' => 'Указан неверный ID студента!',
            'name.required' => 'Необходимо ввести имя!',
            'class_id.required' => 'Необходимо указать ID класса.',
            'class_id.exists' => 'Указан ID несуществующего класса.'
        ];
    }
}
