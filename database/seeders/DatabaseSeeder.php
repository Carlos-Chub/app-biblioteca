<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookReader;
use App\Models\Reader;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
        Author::factory()->count(10)->create();
        Book::factory()->count(10)->create();
        Reader::factory()->count(10)->create();
        BookReader::factory()->count(10)->create();
    }
}
