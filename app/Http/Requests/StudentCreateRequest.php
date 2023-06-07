<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class StudentCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'class_id' => 'exists:classes,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Необходимо ввести имя!',
            'email.required' => 'Необходимо ввести e-mail!',
            'email.email' => 'Неверный формат e-mail!',
            'email.unique' => 'Такой e-mail уже есть в системе!',
            'exists' => 'Указан ID несуществующего класса.'
        ];
    }
}
