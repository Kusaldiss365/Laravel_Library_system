<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'author'=> $this->faker->name,
            'pub_year'=> $this->faker->numberBetween($min = 1900, $max = 2024),
            'description' => $this->faker->sentence,
        ];
    }
}
