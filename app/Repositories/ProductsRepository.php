<?php

namespace App\Repositories;

use App\Entity\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductsRepository
{
    public function paginate($limit = 15): LengthAwarePaginator
    {
        return Product::orderBy('id', 'DESC')->paginate($limit);
    }

    public function find(string $q, $limit = 15): LengthAwarePaginator
    {
        return Product::orderBy('id', 'DESC')->where('name', 'LIKE', "%{$q}%")->paginate($limit);
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

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
