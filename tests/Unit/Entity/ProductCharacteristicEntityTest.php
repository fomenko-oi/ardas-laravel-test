<?php

namespace Tests\Unit\Entity;

use App\Entity\Characteristic;
use App\Entity\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductCharacteristicEntityTest extends TestCase
{
    use DatabaseMigrations;

    public function testSuccessCreate()
    {
        /** @var Characteristic $characteristic */
        $characteristic = factory(Characteristic::class)->create(['name' => 'Color', 'type' => Characteristic::TYPE_STRING]);

        $this->assertEquals('Color', $characteristic->name);
        $this->assertTrue($characteristic->isString());
        $this->assertFalse($characteristic->isSelect());
        $this->assertCount(0, $characteristic->getOptions());
    }

    public function testSuccessSelectCreate()
    {
        /** @var Characteristic $characteristic */
        $characteristic = factory(Characteristic::class)->create([
            'name' => 'Color',
            'type' => Characteristic::TYPE_SELECT,
            'options' => ['red', 'blue', 'green'],
        ]);

        $this->assertFalse($characteristic->isString());
        $this->assertTrue($characteristic->isSelect());
        $this->assertCount(3, $characteristic->getOptions());
    }

    public function testSuccessSelectCreateWithoutOptions()
    {
        /** @var Characteristic $characteristic */
        $characteristic = factory(Characteristic::class)->create([
            'name' => 'Color',
            'type' => Characteristic::TYPE_SELECT,
            'options' => [],
        ]);

        $this->assertFalse($characteristic->isString());
        $this->assertTrue($characteristic->isSelect());
        $this->assertCount(0, $characteristic->getOptions());
    }
}
