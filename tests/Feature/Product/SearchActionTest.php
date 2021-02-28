<?php

namespace Tests\Feature\Product;

use App\Entity\Characteristic;
use App\Entity\CharacteristicValue;
use App\Entity\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessProductCreate()
    {
        $response = $this->postJson('/api/products/search', ['q' => 'test']);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'data' => []
        ]);
    }

    public function testSuccessFoundProducts()
    {
        factory(Product::class, 5)->create();
        $product = factory(Product::class)->create(['name' => 'searchable']);
        $product2 = factory(Product::class)->create(['name' => 'searchable2']);

        $response = $this->postJson('/api/products/search', ['q' => 'searchable']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    ['id' => $product2->id, 'name' => $product2->name],
                    ['id' => $product->id, 'name' => $product->name],
                ]
            ])
            ->assertJsonCount(2, 'data');
    }

    public function testEmptyQueryValidationError()
    {
        $response = $this->postJson('/api/products/search', ['q' => '']);

        $response->assertStatus(422)->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'q' => ['The q field is required.']
            ]
        ]);
    }

    public function testShortQueryValidationError()
    {
        $response = $this->postJson('/api/products/search', ['q' => 'x']);

        $response->assertStatus(422)->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'q' => ['The q must be at least 2 characters.']
            ]
        ]);
    }
}
