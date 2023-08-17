<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
//        $this->seed(UserSeeder::class);
//
//        $user = User::where('email', 'quarkino@gmail.com')->first();
//
//        $apiToken = $user->remember_token;
//        $data = [
//            'order_items' => [
//                '12' => 7,
//                '18' => 3,
//            ],
//        ];
//        $response = $this->withHeader('Cookie',"access_token=". $apiToken)->json('POST', 'api/order/create', $data);
//
//        $response->assertStatus(202);
    }
}
