<?php

namespace Tests\Feature\Product;

use App\Entity\Characteristic;
use App\Entity\CharacteristicValue;
use App\Entity\Product;
use App\Repositories\ProductsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateActionTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessProductCreate()
    {
        $response = $this->post('/products', [
            'name' => 'Test product',
            'price' => 100
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Product successful created.')
            ->assertRedirect(route('products.index'))
        ;
    }

    public function testSuccessProductCharacteristicsCreate()
    {
        $characteristics = factory(Characteristic::class, 4)->create();

        $characteristicValues = [];

        /** @var Characteristic $characteristic */
        foreach ($characteristics as $characteristic) {
            // skip some of the characteristics
            if (random_int(0, 3) === 3) {
                continue;
            }

            $characteristicValues[$characteristic->id] = "Test value {$characteristic->id}";
        }

        $response = $this->post('/products', [
            'name' => 'Test product',
            'price' => 100,
            'characteristics' => $characteristicValues
        ]);

        $response->assertStatus(302);

        $product = Product::with('characteristicValues')->orderBy('id', 'DESC')->first();

        $realProductCharacteristics = [];
        foreach ($product->characteristicValues as $value) {
            $realProductCharacteristics[$value->characteristic_id] = "Test value {$value->characteristic_id}";
        }

        $this->assertEquals($characteristicValues, $realProductCharacteristics);
    }

    public function testProductRequiredFieldsValidation()
    {
        $response = $this->post('/products', ['name' => null, 'price' => null]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['name' => 'The name field is required.', 'price' => 'The price field is required.'])
        ;
    }

    public function testProductShortName()
    {
        $response = $this->post('/products', ['name' => 'x', 'price' => 100]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['name' => 'The name must be at least 3 characters.'])
        ;
    }

    public function testProductInvalidPrice()
    {
        $response = $this->post('/products', ['name' => 'Test name', 'price' => 'invalid']);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['price' => 'The price must be an integer.'])
        ;
    }

    public function testProductWithWrongCharacteristicIds()
    {
        $characteristic = factory(Characteristic::class)->create();

        $response = $this->post('/products', [
            'name' => 'Test product',
            'price' => 100,
            'characteristics' => [$characteristic->id => 'test correct', 100500 => 'test wrong one']
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['characteristic_ids.1' => 'The selected characteristic_ids.1 is invalid.'])
        ;
    }
}
