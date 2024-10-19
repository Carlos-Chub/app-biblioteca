<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'auxiliar',
            'email' => 'bibliojose18@gmail.com',
            'password' => Hash::make('biblio24'),
        ]);

        User::create([
            'name' => 'auxiliar2',
            'email' => 'sergioyaxcal123@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
