<?php

namespace App\Http\Actions\Product;

use App\Entity\Product;
use App\Http\Actions\ApiResponsesTrait;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class Delete
{
    use ApiResponsesTrait;

    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function execute(Product $product, Request $request)
    {
        try {
            $this->products->delete($product);

            return $request->ajax()
                ? $this->success()
                : redirect()->route('products.index')->with('success', 'Product has been removed.');
        } catch (\Exception $e) {
            return $request->ajax()
                ? $this->error($e->getMessage())
                : redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }
}
