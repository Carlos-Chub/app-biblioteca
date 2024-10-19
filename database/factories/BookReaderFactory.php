<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Reader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookReader>
 */
class BookReaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reader_id' => Reader::factory(),
            'book_id' => Book::factory(),
            'status' => $this->faker->randomElement(['in use', 'returned']),
            'sms' => $this->faker->randomElement([1, 0]),
            'whatsapp' => $this->faker->randomElement([1, 0]),
            'email' => $this->faker->randomElement([1, 0]),
            'return_date' => $this->faker->date(),
        ];
    }
}
