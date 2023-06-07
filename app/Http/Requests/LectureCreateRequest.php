<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'subject' => 'required|unique:lectures,subject',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Необходимо ввести название!',
            'subject.unique' => 'Лекция с таким названием уже есть!',
            'description.required' => 'Необходимо ввести описание!',
        ];
    }
}
