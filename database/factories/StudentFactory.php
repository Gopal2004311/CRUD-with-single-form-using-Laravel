<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "std_name" => fake()->name(),
            "email" => fake()->unique()->email(),
            "std_class" => fake()->word(),
            "age" => fake()->numberBetween(15, 30),
        ];
    }
}
