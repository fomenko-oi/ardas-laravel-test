<?php

namespace App\Repositories;

use App\Entity\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductsRepository
{
    public function find(string $q, $limit = 15): Collection
    {
        return Product::where('name', 'LIKE', "%{$q}%")->limit($limit)->get();
    }

    public function create(string $name, int $price): Product
    {
        return Product::create(['name' => $name, 'price' => $price]);
    }

    public function update(Product $product, string $name, int $price): void
    {
        $product->update(['name' => $name, 'price' => $price]);
    }

    public function getById(int $id): Product
    {
        return Product::with(['characteristicValues'])->findOrFail($id);
    }
}
