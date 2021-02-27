<?php

namespace Tests\Feature\Product;

use App\Entity\Characteristic;
use App\Entity\CharacteristicValue;
use App\Entity\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessProductUpdate()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create([
            'name' => 'Test product',
            'price' => 100
        ]);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated product',
            'price' => 100500
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true,
            'data' => [
                'id' => $product->id,
                'name' => 'Updated product',
                'price' => 100500
            ]
        ])->assertJsonStructure(['success', 'data' => ['id', 'name', 'price', 'created_at']]);
    }
}
