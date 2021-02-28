<?php

use App\Repositories\CharacteristicsRepository;
use Illuminate\Database\Seeder;
use App\Entity\Characteristic;

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
        $this->characteristics->create('Size', Characteristic::TYPE_SELECT, ['xl', 'md', 'xxl']);
    }
}
