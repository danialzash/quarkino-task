<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'quarkino',
             'email' => 'quarkino@gmail.com',
             'password' => env('QUARKINO_PASSWORD', "$2y$10$3ggWa7qAD3elHe9AwZNBzu.FSSqy1ObbPptxYeBYgWM9GfnuPknZ6"),
         ]);
    }
}
