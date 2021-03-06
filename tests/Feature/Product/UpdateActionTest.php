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

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Updated product',
            'price' => 100500
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Product successful updated.')
            ->assertRedirect(route('products.index'))
        ;
    }
}
