<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassForStudy>
 */
class ClassForStudyFactory extends Factory
{

    public function definition(): array
    {
        return [
                'name' => strtoupper(fake()->unique()->randomLetter().'-'.fake()->numberBetween(1,10)),
        ];
    }
}
