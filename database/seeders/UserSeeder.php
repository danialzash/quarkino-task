<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'quarkino',
            'email' => 'quarkino@gmail.com',
            'password' => env('QUARKINO_PASSWORD', "$2y$10$3ggWa7qAD3elHe9AwZNBzu.FSSqy1ObbPptxYeBYgWM9GfnuPknZ6"),
        ]);

        Log::channel('slack')->info("Quarkino user has been generated via seeder! :boom:");
    }
}
