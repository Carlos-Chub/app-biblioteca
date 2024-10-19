<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reader>
 */
class ReaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'names' => $this->faker->word,
            'surnames' => $this->faker->word,
            'date_birthday' => $this->faker->date(),
            'phone' => '+502' . $this->faker->numberBetween(10000000, 99999999),
            'address' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
