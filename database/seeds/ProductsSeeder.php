<?php

use App\Entity\Product;
use App\UseCases\Product\ProductService;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        factory(Product::class, 35)->create();
    }
}
