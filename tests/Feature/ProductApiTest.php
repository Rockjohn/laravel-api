<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\User;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_retrieve_product_by_id()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $product->name, 
            'description' => $product->description
        ]);
    }

    public function test_create_product_with_authentication()
    {
        $user = User::factory()->create();
        $token = $user->createToken('testToken')->plainTextToken;

        $productData = [
            'name' => 'Test product name',
            'description' => 'Test product description',
            'price' => 105.99
        ];

        $response = $this->withToken($token)->postJson('/api/products', $productData);

        $response->assertStatus(201);
        $response->assertJsonFragment($productData);
    }

    public function test_create_product_without_authentication()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'Test product description',
            'price' => 99.02
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(401);
    }

    public function test_update_product_with_authentication()
    {
        $user = User::factory()->create();
        $token = $user->createToken('testToken')->plainTextToken;
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Name updated by test',
            'description' => 'test descr.',
            'price' => 123.23
        ];

        $response = $this->withToken($token)->putJson("/api/products/{$product->id}", $updatedData);

        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Product '.$product->id.' updated successfully']);
    }

    public function test_delete_product_with_authentication()
    {
        $user = User::factory()->create();
        $token = $user->createToken('testToken')->plainTextToken;
        $product = Product::factory()->create();

        $response = $this->withToken($token)->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);
    }
}
