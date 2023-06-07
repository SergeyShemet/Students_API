<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:classes,id',
            'name' => 'required|unique:classes,name,'.$this->request->get('id'),
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID класса!',
            'id.exists' => 'Указан неверный ID класса!',
            'name.required' => 'Необходимо ввести название!',
            'name.unique' => 'Класс с таким названием уже есть!',
        ];
    }

}
