<?php

namespace Tests\Unit\Entity;

use App\Entity\Characteristic;
use App\Entity\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductEntityTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessProductCreate()
    {
        $product = factory(Product::class)->create([
            'name' => 'test product',
            'price' => 1000
        ]);

        $this->assertEquals('test product', $product->name);
        $this->assertEquals(1000, $product->price);
    }

    public function testSuccessCharacteristicCreate()
    {
        /** @var Product $product */
        $product = factory(Product::class)->create();

        $characteristic = factory(Characteristic::class)->create(['name' => 'Color']);
        $this->assertEquals('Color', $characteristic->name);

        $characteristicValue = $product->addCharacteristic($characteristic->id, 'red');
        $this->assertEquals($characteristic->id, $characteristicValue->characteristic_id);
        $this->assertEquals('red', $characteristicValue->value);

        $this->assertEquals(1, $product->characteristicValues->count());

        $this->assertEquals('red', $product->characteristicValues->first()->value);
    }
}
