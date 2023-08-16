<?php

namespace Tests\Feature;

use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductSeederTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->seed(ProductSeeder::class);
        // Just for test 100 products are generate with fake names and 9 are generated from csv file.
        $this->assertDatabaseCount('products', 109);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
