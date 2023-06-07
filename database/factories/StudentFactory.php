<?php

namespace Database\Factories;
use App\Models\ClassForStudy;


use Illuminate\Database\Eloquent\Factories\Factory;


class StudentFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'class_id' => ClassForStudy::all()->random()->id
        ];
    }
}
