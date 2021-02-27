<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(random_int(3, 5)),
        'price' => $faker->randomNumber(4),
    ];
});
