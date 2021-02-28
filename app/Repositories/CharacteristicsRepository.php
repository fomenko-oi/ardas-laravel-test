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

    public function create(string $name, string $type = Characteristic::TYPE_STRING, array $options = []): Characteristic
    {
        if (!array_key_exists($type, Characteristic::getTypesList())) {
            throw new \DomainException("Unable to create {$type} type.");
        }

        if ($type === Characteristic::TYPE_STRING && count($options) > 0) {
            throw new \DomainException("Unable to create string type with options.");
        }

        return Characteristic::create([
            'name'      => $name,
            'type'      => $type,
            'options'   => $options,
        ]);
    }
}
