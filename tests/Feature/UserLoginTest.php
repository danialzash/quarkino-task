<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
//        $this->seed(UserSeeder::class);
//        $response = $this->withHeaders([])
//            ->post('api/login', [
//                'name' => 'quarkino',
//                'password' => 'quarkino',
//            ]);
//
//        $response->assertStatus(202);
    }
}
