<?php

use App\Entity\Characteristic;
use App\Repositories\CharacteristicsRepository;
use App\UseCases\Product\ProductService;
use Illuminate\Database\Seeder;

class CharacteristicsSeeder extends Seeder
{
    /**
     * @var CharacteristicsRepository
     */
    private $characteristics;

    public function __construct(CharacteristicsRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function run()
    {
        $this->characteristics->create('Recommended room area');
        $this->characteristics->create('Color');
        //$this->characteristics->create('Size', Characteristic::TYPE_SELECT, ['xl', 'md', 'xxl']);
    }
}
