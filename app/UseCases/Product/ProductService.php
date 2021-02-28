<?php

namespace App\UseCases\Product;

use App\Entity\Product;
use App\Repositories\ProductsRepository;

class ProductService
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function search(string $q, $limit = 15)
    {
        return $this->products->find($q, $limit);
    }

    public function create(string $name, int $price, array $characteristics = []): Product
    {
        $product = $this->products->create($name, $price);

        if (count($characteristics) > 0) {
            $this->addCharacteristics($product, $characteristics);
        }

        return $product;
    }

    public function update(int $productId, string $name, int $price, array $characteristics = []): Product
    {
        $product = $this->products->getById($productId);

        $this->products->update($product, $name, $price);

        $product->characteristicValues()->delete();
        if (count($characteristics) > 0) {
            $this->addCharacteristics($product, $characteristics);
        }

        return $product;
    }

    private function addCharacteristics(Product $product, array $characteristics = [])
    {
        if (count($characteristics) > 0) {
            foreach ($characteristics as $id => $value) {
                if (empty($value)) {
                    continue;
                }

                $product->addCharacteristic($id, $value);
            }
        }
    }
}
