<?php

namespace App\Repositories;

use App\Entity\Characteristic;
use Illuminate\Database\Eloquent\Collection;

class CharacteristicsRepository
{
    public function findAll(): Collection
    {
        return Characteristic::get();
    }
}
