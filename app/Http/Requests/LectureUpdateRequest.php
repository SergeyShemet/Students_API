<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:lectures,id',
            'subject' => 'required|unique:lectures,subject,'.$this->request->get('id'),
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID лекции!',
            'id.exists' => 'Указан неверный ID лекции!',
            'subject.required' => 'Необходимо ввести название!',
            'subject.unique' => 'Лекция с таким названием уже есть!',
            'description.required' => 'Необходимо ввести описание!',
        ];
    }
}
