<?php

namespace Tests\Feature\Product;

use App\Entity\Characteristic;
use App\Entity\CharacteristicValue;
use App\Entity\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessProductDelete()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $response = $this->delete("/products/{$product->id}");

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Product has been removed.')
            ->assertRedirect(route('products.index'))
            ->assertSessionDoesntHaveErrors()
        ;
    }

    public function testSuccessProductAjaxDelete()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $response = $this->deleteJson("/products/{$product->id}", [], ['X-Requested-With' => 'XMLHttpRequest']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => []
            ])
        ;
    }

    public function testNotExistedProductDelete()
    {
        $response = $this->delete('/products/100500');

        $response->assertStatus(404);
    }
}
