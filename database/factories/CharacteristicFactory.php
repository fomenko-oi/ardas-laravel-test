<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Characteristic;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Characteristic::class, function (Faker $faker) {
    $type = Arr::random(array_keys(Characteristic::getTypesList()));

    return [
        'name' => $faker->word,
        'type' => $type,
        'options' => $type === Characteristic::TYPE_SELECT ? $faker->words(random_int(1, 5)) : [],
    ];
});
