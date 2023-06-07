<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassSetPlanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:classes,id',
            'lectures' => 'required|array|min:1',
            'lectures.*' => 'required|distinct|integer|exists:lectures,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Не указан ID класса!',
            'id.exists' => 'Указан неверный ID класса!',
            'lectures.required' => 'Не указан массив лекций!',
            'lectures.*.required' => 'Не указаны данные массива лекций!',
            'lectures.*.distinct' => 'Список лекций содержит повторяющиеся значения.',
            'lectures.*.integer' => 'Список лекций содержит не числа, а должны быть числа.',
            'lectures.*.exists' => 'Список лекций содержит несуществующие лекции'
        ];
    }
}
