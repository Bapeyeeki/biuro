<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tworzenie użytkowników testowych
        User::factory()->create([
            'name' => 'Jan Kowalski',
            'email' => 'jan@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Anna Nowak',
            'email' => 'anna@example.com',
            'password' => bcrypt('password'),
        ]);

        // Dodaj użytkownika admin (test)
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.pl',
            'password' => bcrypt('admin1234'),
        ]);
        
        // Wywołanie seedera biur
        $this->call(OfficeSeeder::class);
    }
}
