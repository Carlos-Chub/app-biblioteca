<?php

namespace Database\Factories;

use App\Models\Author;
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
            'uuid' => $this->faker->uuid,
            'title' => fake()->title(),
            'author_id' => Author::factory(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'book_case' => $this->faker->word,
            'row' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
