<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use App\Models\Rating;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Idris Muhammad',
            'email' => 'idrismuhammad257@gmail.com',
            'nohp' => '085746249265',
            'password' => bcrypt('12345'),
            'is_admin' => '2',
        ]);

        User::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Rating::create([
            'name' => '5',
        ]);

        Rating::create([
            'name' => '4',
        ]);

        Rating::create([
            'name' => '3',
        ]);

        Rating::create([
            'name' => '2',
        ]);

        Rating::create([
            'name' => '1',
        ]);
    }
}
