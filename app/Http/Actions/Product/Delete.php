<?php

namespace App\Http\Actions\Product;

use App\Entity\Product;
use App\Repositories\ProductsRepository;

class Delete
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function execute(Product $product)
    {
        try {
            $this->products->delete($product);

            return redirect()->route('products.index')->with('success', 'Product has been removed.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }
}
